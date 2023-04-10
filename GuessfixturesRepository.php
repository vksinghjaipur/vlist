<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Guessfixtures\GuessfixtureCreated;
use App\Events\Backend\Guessfixtures\GuessfixtureDeleted;
use App\Events\Backend\Guessfixtures\GuessfixtureUpdated;
use App\Exceptions\GeneralException;
use App\Models\Guessfixture;
use App\Models\GuessfixtureCategory;
use App\Models\GuessfixtureMapCategory;
use App\Models\GuessfixtureMapTag;
use App\Models\GuessfixtureTag;
use App\Models\League;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuessfixturesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Guessfixture::class;

    protected $upload_path;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'league_id',
        'league_country',
        'league_name',
        'team_home_name',
        'team_home_logo',
        'publish_datetime',
        'date',
        'status',
        'start',
        'end',
        'created_at',
        'updated_at',
    ];

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'guessfixture'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'owner',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'guessfixtures.created_by')
            //->join('leagues', 'leagues.league_id', '=', 'guessfixtures.league_id')
            ->orderBy('guessfixtures.league_id','asc')
            ->groupBy('guessfixtures.team_home_name')
            ->select([
                'guessfixtures.id',
                'guessfixtures.league_id',
                'guessfixtures.league_country',
                'guessfixtures.league_name',
                'guessfixtures.team_home_name',
                'guessfixtures.publish_datetime',
                'guessfixtures.date',
                'guessfixtures.league_season',
                //'leagues.start',
                //'leagues.end',
                'guessfixtures.status',
                'guessfixtures.created_by',
                'guessfixtures.created_at',
                'users.first_name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        
        $input['status'] = $input['status'] ?? 0;
        $input['date'] = Carbon::parse($input['date']);
        $input['publish_datetime'] = $input['publish_datetime'];
        $input['created_by'] = auth()->user()->id;
        
        /* v image  */
        $input = $this->uploadImage($input);

        if ($guessfixture = Guessfixture::create($input)) {
            event(new GuessfixtureCreated($guessfixture));

            return $guessfixture;
        }

        throw new GeneralException(__('exceptions.backend.guessfixture.create_error'));
    }

    /**
     * @param \App\Models\Fixture $fixture
     * @param array $input
     */
   public function update(Guessfixture $guessfixture, array $input)
    {

        
        if(!empty($input['league_logo'])){
        $input['league_logo']=$input['league_logo'];
        }else{
            unset($input['league_logo']);
        }

        if(!empty($input['team_home_logo'])){
        $input['team_home_logo']=$input['team_home_logo'];
        }else{
            unset($input['team_home_logo']);
        }

        if(!empty($input['team_away_logo'])){
        $input['team_away_logo']=$input['team_away_logo'];
        }else{
            unset($input['team_away_logo']);
        }
       
        
        $input['status'] = $input['status'] ?? 0;
        $input['updated_by'] = auth()->user()->id;
        $input['date'] = Carbon::parse($input['date']);
        $input['publish_datetime'] = $input['publish_datetime'];

        if ($guessfixture->update($input)) {
            event(new GuessfixtureUpdated($guessfixture));

            return $guessfixture->fresh();
        }
		
        throw new GeneralException(__('exceptions.backend.guessfixture.update_error'));
    }

       
    /**
     * @param \App\Models\Fixtures\Fixture $fixture
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Guessfixture $guessfixture)
    {
        if ($guessfixture->delete()) {
            event(new GuessfixtureDeleted($guessfixture));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.guessfixture.delete_error'));
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
  //   public function uploadImage($input)
  //   {
  //       if (isset($input['team_home_logo']) && ! empty($input['team_home_logo'])) {
  //           $avatar = $input['team_home_logo'];
  //           $fileName = time().$avatar->getClientOriginalName();

  //           $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

  //           $input = array_merge($input, ['team_home_logo' => $fileName]);
  //       }
		
		// if (isset($input['team_away_logo']) && ! empty($input['team_away_logo'])){
  //           $avatar = $input['team_away_logo'];
  //           $fileName = time().$avatar->getClientOriginalName();

  //           $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

  //           $input = array_merge($input, ['team_away_logo' => $fileName]);
  //       }

  //       return $input;
  //   }

    public function uploadImage($input)
    {
        if (isset($input['team_home_logo']) && ! empty($input['team_home_logo'])) {
            $avatar = $input['team_home_logo'];
            $fileName = time().$avatar->getClientOriginalName();
            $destinationPath = public_path('/img/guessfixtures/');
            $avatar->move($destinationPath, $fileName);
            //$this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));
            $input = array_merge($input, ['team_home_logo' => $fileName]);
        }

        if (isset($input['team_away_logo']) && ! empty($input['team_away_logo'])) {
            $avatar = $input['team_away_logo'];
            $fileName = time().$avatar->getClientOriginalName();

            $destinationPath = public_path('/img/guessfixtures/');
            $avatar->move($destinationPath, $fileName);
            //$this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));
            $input = array_merge($input, ['team_away_logo' => $fileName]);
        }
        
        return $input;
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->team_home_logo;
		$fileName = $model->team_away_logo;

        return $this->storage->delete($this->upload_path.$fileName);
    }
}

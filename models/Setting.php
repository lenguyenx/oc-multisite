<?php namespace Keios\Multisite\Models;

use Model;
use Config;
use DirectoryIterator;
use Cache;
use Request;

/**
 * Setting Model
 */
class Setting extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'domain' => 'required|url',
        'theme' => 'required',
    ];
    /**
     * @var string The database table used by the model.
     */
    public $table = 'keios_multisite_settings';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['domain', 'theme', 'is_protected'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /*
     * Get all currently available themes, return them to form widget for selection
     */
    public function getThemeOptions()
    {
        $path = base_path() . Config::get('cms.themesDir');
        $themeDirs = [];

        foreach (new DirectoryIterator($path) as $file) {
            if ($file->isDot()) continue;
            if ($file->isDir()) {
                $name = $file->getBasename();
                $themeDirs[$name] = $name;
            }
        }

        return $themeDirs;
    }

    public function beforeSave()
    {
        if (preg_match('/' . Request::getHost() . '/', $this->domain) && $this->is_protected) return false;
    }

    /*
     * Update cache after saving new domain - theme set
     */
    public function afterSave()
    {
        // forget current data
        Cache::forget('keios_multisite_settings');

        // get all records available now
        $cacheableRecords = Setting::generateCacheableRecords();

        //save them in cache
        Cache::forever('keios_multisite_settings', $cacheableRecords);
    }

    public static function generateCacheableRecords()
    {
        $allRecords = Setting::all()->toArray();
        $cacheableRecords = [];

        foreach ($allRecords as $record) {
            $cacheableRecords[$record['domain']] = [
                'theme' => $record['theme'],
                'is_protected' => $record['is_protected']
            ];
        }

        return $cacheableRecords;
    }
}
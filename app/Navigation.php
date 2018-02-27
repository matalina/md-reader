<?php namespace App;

use Illuminate\Support\Collection;
use Storage;

class Navigation {
    protected $items = null;
    
    public function get() 
    {
        $disk = Storage::disk('notebook');
        $items = [];

        $this->items = $this->recursiveMenuCreation($disk, $items, '/');
        
        return $this->items;
    }
    
    public function create()
    {
        return view('layouts.menu')
            ->with('folders', $this->items['folders'])
            ->with('links', $this->items['links']);
    }

    protected function recursiveMenuCreation($disk, $items, $path)
    {
        $dirs = $disk->directories($path);
        $files = $disk->files($path);
        
         foreach($dirs as $dir) {
             if(preg_match('/\.git/',$dir)) {
                 continue;
             }
            $segments = explode('/',$dir);
            $uri = $segments[count($segments) - 1];
            preg_match('/([0-9]*)\[_-]*(.+)/', $uri, $match);
             if(empty($match)) {
                 $name = $uri;
             }
             else {
                 $name = $match[2];
             }
            $new_dir = [];
            $new_dir = $this->recursiveMenuCreation($disk, $new_dir, $dir);
            $name = str_replace('-', ' ', $name);
            $order = !empty($match[1])?$match[1]:$name;
            $items['folders'][] = [
                'name' => $name,
                'uri' => $dir,
                'folders' => $new_dir,
            ];
        }

        foreach($files as $file) {
            $segments = explode('/',$file);
            $uri = explode('.', $segments[count($segments) - 1]);
            preg_match('/([0-9]*)[_-]*(.+)/', $uri[0], $match);
            $name = str_replace('-', ' ', $match[2]);
            $link = explode('.', $file);
            if(count($link) < 2) {
                $ext = 'md';
            }
            else {
                $ext = $link[1];
            }
                
            $link_uri = $link[0];
            $order = !empty($match[1])?$match[1]:$name;
            if($ext == 'md') {
                $items['links'][] = [
                    'name' => $name,
                    'url' => route('page',['page' => base64_encode($link_uri)]),
                ];
            }
        }
        
        return $items;
    }
}
<?php namespace App;

use Illuminate\Support\Collection;
use Storage;

class Navigation {
    protected $items = null;
    
    public function get() 
    {
        $disk = Storage::disk('notebook');
        $items = new Collection();

        $this->items = $this->recursiveMenuCreation($disk, $items, '/');
        
        return $this;
    }
    
    public function create()
    {
        return view('layouts.menu')
            ->with('items',$this->items);
    }

    protected function recursiveMenuCreation($disk, $items, $path)
    {
        $dirs = $disk->directories($path);
        $files = $disk->files($path);
        
         foreach($dirs as $dir) {
            $segments = explode('/',$dir);
            $uri = $segments[count($segments) - 1];
            preg_match('/([0-9]*)\_?(.+)/', $uri, $match);
            $new_dir = new Collection();
            $new_dir = $this->recursiveMenuCreation($disk, $new_dir, $dir);
            $name = str_replace('-', ' ', $match[2]);
            $order = !empty($match[1])?$match[1]:$name;
            $items->put($order, [
                'name' => $name,
                'uri' => $dir,
                'folder' => $new_dir,
            ]);
        }

        foreach($files as $file) {
            $segments = explode('/',$file);
            $uri = explode('.', $segments[count($segments) - 1]);
            preg_match('/([0-9]*)\_?(.+)/', $uri[0], $match);
            $name = str_replace('-', ' ', $match[2]);
            $link = explode('.', $file);
            $link_uri = $link[0];
            $order = !empty($match[1])?$match[1]:$name;
            $items->put($order, [
                'name' => $name,
                'link' => base64_encode($link_uri),
            ]);
        }

        return $items;
    }
}
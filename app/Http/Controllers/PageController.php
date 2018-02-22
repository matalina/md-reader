<?php

namespace App\Http\Controllers;

use function htmlspecialchars;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Storage;
use League\CommonMark\CommonMarkConverter;
use App\Navigation;
use \Mni\FrontYAML\Bridge\CommonMark\CommonMarkParser;
use \Mni\FrontYAML\Parser;

class PageController extends Controller
{
    protected $converter;
    protected $nav;
    protected $menu;
    
    public function __construct(Navigation $nav)
    {
        $parser = new Parser(null, new CommonMarkParser());
        
        $this->converter = $parser;
        $this->navigation = $nav;
        $this->menu = $this->navigation->get()->create();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page = null)
    {
       if($page == null) {
           $link = 'home.md';
       } 
       else { 
            $link = base64_decode($page).'.md'; 
       }

        $contents = Storage::disk('notebook')->get($link);
        
        $document = $this->converter->parse($contents);

        $yaml = $document->getYAML();
        
        if(empty($yaml)) {
            $titles = [];
            $yaml = [];
        }
        else {
            if(isset($yaml['titles'])) {
                $titles = $yaml['titles'];
            }
            else {
                $titles = [];
            }
        }
        
        $html = $document->getContent();
        
        return view('welcome')
            ->with('menu',$this->menu)
            ->with('titles', $titles)
            ->with('footer',$yaml)
            ->with('page', $html);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

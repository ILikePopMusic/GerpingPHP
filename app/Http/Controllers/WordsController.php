<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Word;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class WordsController extends Controller
{
    public function getWord(Request $request) {

        $articleInput = $request->input('button') ?? NULL;      
       

        //access article from the fucking session token, which is the last 3 characters of the url string --- there must be a better way to do this
       

        //randomize word id and pull it from DB
        $id = rand(0, 676);
        $randomWord = $this->getVocab($id);                
        $word = $randomWord[0]->word ?? '';      
        $article_1 = $randomWord[0]->article_1 ?? '';
        $article_2 = $randomWord[0]->article_2 ?? '';        
               
        $session = $request->session()->all();
        $request->session()->put('article1', $article_1); //only checking one until shit works
        $request->session()->put('article2', $article_2);
        $request->session()->put('word', $word);       
        
        $oldArticle1 = $session['article1'] ?? '';
        $oldArticle2 = $session['article2'] ?? '';        
        $oldWord = $session['word'] ?? '';        

        $user_id = $request->user()->id ?? NULL;     
        $correct = $this->checkArticle($articleInput, $oldArticle1, $oldArticle2);

        if ($user_id != NULL && $articleInput != NULL) {
            $tableName = 'stats_by_'.$user_id;
            $this->addStats($tableName, $oldArticle1, $oldArticle2, $oldWord, $articleInput, $correct);        
        }

        if ($articleInput == '') {
            return view('practice', ['word' => $word]);
        } elseif ($correct) {
            return view('practice', ['word' => $word, 'answer' => 'yes']);
        } else {
            return view('practice', ['word' => $word, 'answer' => 'no']);
        }       
 
    }
    

    public function getVocab($id) { 
        $randomWord = Word::where("id", $id)->get();        
        return $randomWord;
    }  

    public function checkArticle($articleInput, $oldArticle1, $oldArticle2) {        
        if ($articleInput == $oldArticle1 || $articleInput == $oldArticle2) {
            return true;
        } else {
            return false;
        }
    }

    public function addStats($tableName, $oldArticle1, $oldArticle2, $oldWord, $articleInput, $correct) {
        DB::table($tableName)->insert([
            'created_at' => Carbon::now(),
            'article_1' => $oldArticle1,       
            'article_2' => $oldArticle2,
            'word' => $oldWord,
            'article_input' => $articleInput,
            'correct' => $correct
        ]);

    }
}

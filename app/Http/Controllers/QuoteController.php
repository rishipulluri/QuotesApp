<?php

namespace App\Http\Controllers;
use App\Quote;
use App\Author;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use App\AuthorLog;

class QuoteController extends Controller
{
    public function postQuote(Request $request) {
        $this -> validate($request,[
            'author' => 'required|max:60|alpha',
            'quote' => 'required|max:500',
            'email' => 'required|email'
            ]);
            
        
        $authorText = ucfirst($request['author']);
        $quoteText = $request['quote'];
        $authorEmail = $request['email'];
        
        $author = Author::where('name', $authorText)->first();
        if (!$author) {
            $author = new Author();
            $author->name = $authorText;
            $author->email = $authorEmail;
            $author->save();
        }
        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);
        
        Event::fire(new QuoteCreated($author));
        return redirect()->route('index')->with([
            'success' => 'Quote saved!'
            ]);
        
        
    }
    
    public function getIndex($author = null) {
                if (!is_null($author))
                {
                    $quote_author = Author::where('name', $author)->first();
                    if ($quote_author)
                    {
                        $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
                    }
                }
                else
                {
                    $quotes = Quote::orderBy('created_at', 'desc')->paginate(6);

                }
                return view('index', ['quotes' => $quotes]);
    }
    
    public function deleteQuote($quote_id) {
        $quote = Quote::find($quote_id);
        $author_deleted = false;
        if (count($quote->author->quotes) === 1)
        {
            $quote->author->delete();
            $author_deleted = true;
        }
        $quote->delete();
        $msg = $author_deleted ? 'Quote and Author has been deleted!' : 'Quote has been deleted!';
        return redirect()->route('index')->with([
            'success' => $msg
            ]);
        
    }
    
    public function getMailCallback($author_name)
    {
        $author_log = new AuthorLog;
        $author_log->name = $author_name;
        $author_log->save();
        return view('email.callback', ['author' => $author_name]);  
    }
}
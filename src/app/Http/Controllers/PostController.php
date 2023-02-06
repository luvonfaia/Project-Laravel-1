<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //

    public function actuallyUpdate(Post $post, Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']); // pt insarare de tag-uri html in body (mallicious)
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields); /* $post este conectat la db avand in spate un model(\Models\Post.php) iar aici ne uitam in $post apeland o metoda
        update caruia ii dam valori din variabila incomingFields*/

        return back()->with('success', 'Postare modificata cu succes!');
    }

    public function showEditForm(Post $post){
        return view('edit-post', ['post' => $post]);
    } 



    public function delete(Post $post)
    {
        if (auth()->user()->cannot('delete', $post)){ // verificare daca cel care doreste sa stearga postarea este chiar autorul. Daca nu este butonul de delete nu apare
            return 'nu poti sterge!';
        }
        $post->delete(); // daca este autorul se va sterge

        return redirect('/profile/' . auth()->user()->username)->with('succes', 'Postare stearsa cu suscces!'); //si va fii redirectionat la celelalte postari(daca exista)
    }


    public function viewSinglePost(Post $post) //metoda care cu ajutorul model Post -> laravel se uita automat in baza de date si cauta title,body,user_id
    {
      $post['body']= strip_tags(Str::markdown($post->body), '<p><ul><ol><li></li></ol></ul><em></em><h3></h3><br>'); //se suprascrie valoarea lui body si o interpretam ca markdown (vezi markdown cheatsheet pe github)

        return view('single-post', ['post' => $post]);
    }



    public function storeNewPost(Request $request) //metoda pentru stocare in baza de date a unei postari noi
    {
        $incomingFields = $request->validate([
           'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']); // pt insarare de tag-uri html in body (mallicious)
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields); /* pentru a salva in baza de date array-ul $incomingFields cu ajutorul clasei model Post ->
 ne ducem la Models/Post linia 12 ; Salvam in variabila $newPost */

        return redirect("/post/{$newPost->id}")->with('success', 'Ai creat o noua postare cu succes!');
    }
    public function showCreateForm()
    {

        return view('create-post');
    }
}

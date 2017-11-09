<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WishlistItem;
use App\User;

class WishlistItemController extends AuthController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $wishlistItems = Auth::user()->wishlistItems->toArray();

    return view('wishlistItem.index', compact('wishlistItems'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('wishlistItem.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $wishlistItem = new WishlistItem([
      'title' => $request->get('title'),
      'description' => $request->get('description'),
      'link' => $request->get('link'),
      'user_id' => Auth::id()
    ]);

    $wishlistItem->save();
    return redirect('/wishlistItem');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if(Auth::user()->ownsItemId($id)) {
      $wishlistItem = WishlistItem::find($id);

      return view('wishlistItem.edit', compact('wishlistItem','id'));
    }
    else {
      return redirect('home');
    }
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
    if(Auth::user()->ownsItemId($id)) {
      $wishlistItem = WishlistItem::find($id);
      $wishlistItem->title = $request->get('title');
      $wishlistItem->description = $request->get('description');
      $wishlistItem->link = $request->get('link');
      $wishlistItem->save();
      return redirect('/wishlistItem');
    }
    else {
      return redirect('home');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if(Auth::user()->ownsItemId($id)) {
      $wishlistItem = WishlistItem::find($id);
      $wishlistItem->delete();

      return redirect('/wishlistItem');
    }
    else {
      return redirect('home');
    }
  }
}

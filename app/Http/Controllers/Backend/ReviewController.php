<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class ReviewController extends Controller
{
   public function reviewstore(Request $request){
        $product_id = $request->product_id;
        $request->validate([
            'comment' => ['required', 'string', 'max:255']
        ]);

        $review = new Review;

        $review->user_id = Auth::id();
        $review->product_id = $product_id;
        $review->comment = $request->comment;
        $review->rating = $request->quality;
        $review->created_at = Carbon::now();
        $review->save();
        return back()->with('message','Review will approve by admin');
    }

    //function for review revie management by admin
    public function pending_review(){
          $review = Review::where('status', 'inactive')->orderBy('id', 'DESC')->get();
          return view('admin.page.review.review', compact('review'));
    }
    
//function for update reviews status
   public function update_review($id){
        $review_update = Review::where('id', $id);
        
        $review_update->update(['status' => 'active']);

        return redirect()->back()->with('message', "Review status updated to approved");
        
   }
//function for showing published review
   public function published_review(){
        $get_reviews = Review::where('status', 'active');
        
        $review = $get_reviews->orderBy('id', 'DESC')->get();

        return view('admin.page.review.published', compact('review'));

        // $review = Review::where('status', 'active')->orderBy('id', 'desc')->get();
        //   return view('admin.page.review.published', compact('review'));
    }

//function for delete review

 public function delete_review($id){
    $delete_review = Review::find($id);
    $delete_review->delete();

    return redirect()->back()->with('message', "Review is deleted success");
 }
   

}

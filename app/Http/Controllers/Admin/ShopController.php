<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use Faker\Provider\Address;
use Illuminate\Http\Request;
use \App\Models\Food;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.foods.manage", [
            "foods" =>Food::orderBy("id", "desc")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.foods.create");
    }

    /**
     * @param FoodRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {


        $validate_data = $request->validated();
        $images = [];
        foreach ($validate_data['images'] as $image){
            $fileName = str_replace(' ', "-", now() . '-' . $image->getClientOriginalName());
            $fileName = str_replace(':', "", $fileName);
            $image->storeAs('foods',$fileName,'public_upload');
            array_push($images, $fileName);
        }

        Food::create([
            "images" => json_encode($images),
            "name" => $validate_data['name'],
            "price" => $validate_data['price'],
            "description" => $validate_data["description"],
        ]);

        return $this->index();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return view("admin.foods.edit",compact("food"));
    }

    /**
     * @param Food $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        return view("admin.foods.edit", compact("food"));
    }

    /**
     * @param FoodRequest $request
     * @param Food $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('image')) {

            $image = array_values($request->file('image'))[0];
//            dd(array_values($image)[0]);
            $fileName = str_replace(' ', "-", now() . '-' . $image->getClientOriginalName());
            $fileName = str_replace(':', "", $fileName);

            $image->storeAs('foods',$fileName,'public_upload');

        } else{
            $fileName = array_keys(array_values($_FILES['image'])[0])[0];
        }
        $food->update([
            "image" => $fileName,
            "name" => $validate_data['name'],
            "price" => $validate_data['price'],
            "description" => $validate_data["description"],
        ]);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        foreach (json_decode($food->images) as $image)
        Storage::disk('foods')->delete($image);
        $food->delete();
        return back();

    }
}

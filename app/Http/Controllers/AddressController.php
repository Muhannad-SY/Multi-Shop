<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $addresses = Address::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();
        $cart = json_decode(Cookie::get('cart', '[]') , true);
        
        return view('theme.address.index', compact('addresses', 'categories' , 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'adreess' => 'required',
            'zip_code' => 'required',
            'title' => 'required',
        ]);
        $new_address = Address::create([
            'user_id' => auth()->id(),
            'adreess' => $request->adreess,
            'zip_code' => $request->zip_code,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Address added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'adreess' => 'required',
            'zip_code' => 'required',
            'title' => 'required',
        ]);
        $address->update([
            'adreess' => $request->adreess,
            'zip_code' => $request->zip_code,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->back()->with('success', 'Address deleted successfully');
    }

    public function editDefLocation(Address $address, Request $request)
    {
        // 1- bring all addresses
        $addresses = Address::where('user_id', $address->user_id)->get();
        // return $addresses;
        // 2- maken if condation to know if Weather there is key in request
        // as name defalt-location then Continue or retrun as wrorning failed the function
        if ($request->default_address != null) {
            // 3- make a for loop to know if one of these addresses have def status as true you
            // will make it false and save it then breake the loop
            foreach ($addresses as $query) {
                if ($query->default_address == 1) {
                    $query->update([
                        'default_address' => 0,
                    ]);
                    break;
                }
            }
        } else {
            return redirect()->back()->with('warning', 'you can not disable your single default address');
        }

        // 4- set the default status as ture to the Specified address.
        $address->update([
            'default_address' => 1
        ]);
          
        
        // 5- redirect to the back page with succece
        return redirect()->back()->with('success', 'Set Default Address');

    }
}

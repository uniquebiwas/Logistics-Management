<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function redirect()
    {
        return request()->is('agent/customer*') ? 'customer.index' : 'customers.index';
    }
    protected function getCustomer($request)
    {
        $query = $this->customer->when(Auth()->user()->agent, function ($query) {
            return $query->where('created_by', Auth()->id());
        });
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getCustomer($request);
        return view('admin/customer/list', compact('data'));
    }

    public function create(Request $request)
    {
        $customer_info = null;
        $title = 'Add New Customer';
        $countries = Country::pluck('name', 'id');
        return view('admin/customer/form', compact('customer_info', 'title', 'countries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:190',
            'email' => 'required|email|unique:customers,email',
            'mobile' => 'required|numeric|numeric',
            'address' => 'required',
            'country' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'created_by' => Auth()->id(),
            'fax'=>$request->fax
        ];
        try {
            $this->customer->fill($data)->save();
            $request->session()->flash('success', 'Customer added successfully.');
            return redirect()->route($this->redirect());
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $customer_info = $this->customer->find($id);
        if (!$customer_info) {
            abort(404);
        }
        if(!$this->checkAccessiblity($customer_info)){
            abort(404);
        }
        $title = 'Update Customer';
        $countries = Country::pluck('name', 'id');
        return view('admin/customer/form', compact('customer_info', 'title', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $customer_info = $this->customer->find($id);
        if (!$customer_info) {
            abort(404);
        }
        if(!$this->checkAccessiblity($customer_info)){
            abort(404);
        }
        $this->validate($request, [
            'name' => 'required|string|min:3|max:190',
            'mobile' => 'required|numeric|numeric',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'country' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'updated_by' => Auth()->id(),
        ];
        if ($request->image) {
            $data['image'] = $request->image;
        }
        try {
            $customer_info->fill($data)->save();
            $request->session()->flash('success', 'Customer updated successfully.');
            return redirect()->route($this->redirect());
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $customer_info = $this->customer->find($id);
        if (!$customer_info) {
            abort(404);
        }
        if(!$this->checkAccessiblity($customer_info)){
            abort(404);
        }
        try {
            $customer_info->delete();
            $request->session()->flash('success', 'Customer deleted successfully.');
            return redirect()->route($this->redirect());
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function checkAccessiblity($customer_info)
    {
        if (Auth()->user()->agent) {
            if ($customer_info->created_by != Auth()->id()) {
                return false;
            }
        }
        return true;
    }
}

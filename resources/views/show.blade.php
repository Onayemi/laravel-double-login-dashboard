@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Project') }}</div>
                {{-- {!! Toastr::message() !!} --}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome to Add Project
                    <form action="{{ route('add.project') }}" method="POST">
                        @csrf
                        <label for="name">Name</label><br/>
                        <input type="text" name="name"><br/>
                        <span style="color: red; font-weight:bold;">@error('name') {{ $message }} @enderror</span><br/>
                        <label for="product">Product</label><br/>
                        <input type="text" name="product"><br/>
                        <span style="color: red; font-weight:bold;">@error('name') {{ $message }} @enderror</span><br/>
                        <fieldset>
                            <label>Extra Toppings</label><br/>
                            <input type="checkbox" name="toppings[]" value="garlics"> Garlics <br/>
                            <input type="checkbox" name="toppings[]" value="tomatoes"> Tomatoes <br/>
                            <input type="checkbox" name="toppings[]" value="apples"> Apples <br/>
                            <input type="checkbox" name="toppings[]" value="beans"> Beans <br/>
                        </fieldset>
                        <input type="submit" class="btn btn-primary btn-sm" value="Add Project">
                    </form>

                    <h1>Order for Pizza {{ $pizzas->name }}</h1>
                    <p>
                        Pizza Product: {{ $pizzas->product }}
                    </p>
                    <p>Extra Toppings</p>
                    <ul>
                        @foreach ($pizzas->toppings as $topping)
                            <li>{{ $topping }}</li>
                        @endforeach
                        {{-- {{ $pizzas->toppings[0] }} --}}
                        {{-- @foreach ($pizzas->toppings as $topping) --}}
                            {{-- <li>{{ $topping }}</li> --}}
                            <form action="#" method="POST"> {{-- {{ route('update/project/', $pizzas->id) }} --}}
                                @csrf
                                <fieldset>
                                    <label>Extra Toppings</label><br/>
                                    <input type="hidden" name="id" value="{{$pizzas->id}}">
                                    @foreach ($pizzas->toppings as $topping)
                                    <input type="checkbox" name="toppings[]" value="{{$topping}}" {{$topping ?'checked':''}}> {{$topping}} <br/>
                                    {{-- <input type="checkbox" name="toppings[]" value="{{$topping}}" {{$topping ? 'checked':''}}> Tomatoes <br/>
                                    <input type="checkbox" name="toppings[]" value="{{$topping}}" {{$topping ? 'checked':''}}> Apples <br/>
                                    <input type="checkbox" name="toppings[]" value="{{$topping}}" {{$topping ? 'checked':''}}> Beans <br/> --}}
                                    @endforeach
                                </fieldset>
                                <input type="submit" class="btn btn-primary btn-sm" value="Edit Project">
                            </form>
                        {{-- @endforeach --}}
                    </ul>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

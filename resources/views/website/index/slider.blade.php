     <!-- Slider -->
     <section class="slider">
         <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
             <div class="carousel-inner">
                 @foreach ($sliders as $key => $slider)
                     <div class="carousel-item @if ($loop->first)
                        {{ 'active' }}
                    @endif"
                         data-bs-interval="3000" data-pause="true">
                         <img src="{{ $slider->image }}" alt="images">
                     </div>
                 @endforeach
             </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                 data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
             </button>
             <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                 data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Next</span>
             </button>
         </div>
         <div class="rate-form">
             <div class="container">
                 <div class="rate-form-wrap">
                     <h3>Check Shipment Price</h3>
                     <p>Quick price Calculator for your shipment.</p>
                     <form name="getPrice" id="getPrice">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>From</label>
                                     <select class="form-select form-control" aria-label="Default select example"
                                         disabled id="from">
                                         <option selected>Nepal</option>
                                         <option value="1">India</option>
                                         <option value="2">Australia</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>To</label>
                                     {!! Form::select('to', $countries, request()->to, ['class' => 'form-select form-control', 'placeholder' => 'Countries', 'id' => 'to']) !!}
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Integrator</label>
                                     {!! Form::select('integrator', $serviceAgent, request()->integrator, ['class' => 'form-select form-control', 'placeholder' => 'integrator', 'id' => 'integrator']) !!}

                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Weight</label>
                                     {!! Form::number('weight', request()->weight, ['placeholder' => 'Weight', 'class' => 'form-control', 'id' => 'weight','step'=>'0.01']) !!}
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-primary" id="checkPrice">Check Price</button>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div id="price" class="d-none">
                                    Your approximate price for the weight (<span id="resultweight"></span>KG) is NPR. <span id="resultprice"></span><br>
                                    <small>T&C apply *</small>
                                 </div>
                             </div>

                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>
     <!-- Slider End -->

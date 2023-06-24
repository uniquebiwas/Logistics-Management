    @if ($welcome)
        <!-- Welcome -->
        <section class="welcome pt pb">
            <div class="container">
                <div class="welcome-wrap">
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="welcome-message">
                                <h4>Air Logistics Group</h4>
                                {!! html_entity_decode($welcome->short_description['en'] ?? null ) !!}
                            </div>
                        </div>
                        @if ($team)
                        {{-- @dd($team->full_name['np']); --}}
                            <div class="col-lg-3 col-md-4">
                                <div class="welcome-team">
                                    <ul>
                                    @foreach ($team as $item)
                                        <li>
                                            <img src="{{ $item->image }}" alt="images">
                                            <h3>{!!($item->full_name['en']) ? $item->full_name['en'] : $item->full_name['np'] !!}</h3>
                                            <p>{!! $item->designation->title['en'] ?? $item->designation->title['np']  !!}</p>
                                        </li>
                                    @endforeach

                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Welcome End -->
    @endif

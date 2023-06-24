<div>

    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-warning">
        <div class="card-header">
            <h3 class="card-title">Packages</h3>

            <div class="card-tools">
                <span title="3 New Messages" class="badge badge-success">{{ count($shipmentPackages) }}</span>
                <input type="date" wire:model="startDate">
                <input type="date" wire:model="endDate">
            </div>
        </div>
        <div class="card-header">
            @if (count($shipmentPackages))
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="checkAllCheckbox"
                        wire:click="$toggle('checkall')" {{ $checkall ? 'checked' : null }}>
                    <label for="checkAllCheckbox" class="custom-control-label">Select All</label>
                </div>
            @endif

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="direct-chat-messages">


                @foreach ($shipmentPackages as $key => $package)
                    <div class="direct-chat-infos" style="display:flex;align-items:center;justify-content:center;"
                        wire:key="{{ $key }}">
                        <!-- /.direct-chat-infos -->
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="shipmentIds[]" type="checkbox"
                                id="{{ $key }}" value="{{ $key }}"
                                wire:model="selectedId.{{ $key }}"
                                {{ in_array($key, $selectedId) ? 'checked' : null }}>
                            <label for="{{ $key }}" class="custom-control-label"></label>
                        </div>
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text" style="flex:3" for="{{ $key }}">
                            {{ $package }}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card-footer">
            <h6 class="bg-dark p-2">
                selected
                @foreach ($selectedPackages as $key => $selected)
                <div class="direct-chat-infos" style="display:flex;align-items:center;justify-content:center;"
                    wire:key="{{ $key . '-' . $key }}">
                    <!-- /.direct-chat-infos -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="shipmentIds[]" type="checkbox"
                            id="{{ $key . '-' . $key }}" value="{{ $key }}"
                            wire:model="selectedId.{{ $key }}"
                            checked="">
                        <label for="{{ $key . '-' . $key }}" class="custom-control-label"></label>
                    </div>
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text" style="flex:3" for="{{ $key . '-' . $key }}">
                        {{ $selected }}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
            @endforeach
            </h6>
        </div>
    </div>
</div>

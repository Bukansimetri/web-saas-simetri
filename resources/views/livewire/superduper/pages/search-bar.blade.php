<div class="blocks search_blocks d-none d-xl-block d-lg-block">
    <div class="input-group">
        <input type="text" class="form-control" wire:model.defer="q" wire:keydown.enter="search" placeholder="Search entire store here...">
        <div class="input-group-append">
            <button wire:click="search" class="btn search_btn" type="button"><i class="ti-search"></i></button>
        </div>
    </div>
</div>

<form class="enable-message-form" action="{{ route($route, $item) }}" method="POST">
    @csrf
    <div class="form-group col-12 mr-3 custom-control custom-switch my-4">
        <input type="checkbox" class="custom-control-input" id="is-active-{{ $item->id }}"
            name="is_active"{{ $item->disactivable() === false ? ' disabled' : '' }}{{ $item->is_active == 1 ? ' checked' : '' }}>
        <label class="custom-control-label" for="is-active-{{ $item->id }}"></label>
    </div>
</form>

<style>
    #addon-wrapping{
        color: var(--text);
        background-color: var(--secondary-color);
    }
    .form-control:disabled{
        color: var(--text);
        background-color: var(--surface-color);
    }
    .form-control::placeholder{
        color: var(--text);
    }
</style>
<div class="input-group flex-nowrap">
    <span class="input-group-text" id="addon-wrapping">Visitor</span>
    <input type="text" class="form-control" placeholder="0" aria-label="Visitors" aria-describedby="Visitors number" disabled>
</div>
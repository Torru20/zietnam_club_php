<style>
    .my-table {
        color: var(--text);
        background-color: var(--surface-color);
    }

    .my-table th {
        background-color: var(--secondary-color);
    }
    .my-table th {
        background-color: var(--secondary-color);
    }
    .table{
        --bs-table-bg: var(--surface-color);
        --bs-table-hover-color: var(--text);
    }
    .table {
        --bs-table-color: var(--primary-color);
        --bs-table-bg: var(--surface-color);
        --bs-table-border-color: var(--primary-color);
        --bs-table-accent-bg: transparent;
        --bs-table-striped-color: var(--primary-color);
        --bs-table-striped-bg: rgba(var(--bs-emphasis-color-rgb), 0.05);
        --bs-table-active-color: var(--bs-emphasis-color);
        --bs-table-active-bg: rgba(var(--bs-emphasis-color-rgb), 0.1);
        --bs-table-hover-color: var(--primary-color);
        --bs-table-hover-bg: rgba(var(--primary-color), 0.075);
    }
    .table>:not(caption)>*>* {
        padding: .5rem .5rem;
        color: var(--bs-table-color-state, var(--bs-table-color-type, var(--text)));
    }
</style>
<div class="table-responsive">
    <table class="table table-hover my-table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="container">
    <div class="row">
        <h1>{stock} History</h1>
    </div>
    <div class="row">
        <div class="dropdown dropdown-menu-right">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Check out other Stocks
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                {dropdownoptions}
            </ul>
        </div>
    </div>
    <div>
        <h4>Current value for {stock}: {value}</h4>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Recent Transactions</h3>
            <div class="table-responsive">
                {trans_table}
            </div>
        </div>
        <div class="col-lg-6">
            <h3>Recent Movements</h3>
            <div class="table-responsive">
                {move_table}
            </div>
        </div>
    </div>
</div>

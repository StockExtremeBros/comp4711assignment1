<div class="container">
    <h1>
        Player Profile
    </h1>
    <div class="row">
        <div class="dropdown dropdown-menu-right">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Check out other Players
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                {dropdownoptions}
            </ul>
        </div>
    </div>
    <div>
        <h4>Current equity for {player}: {equity}</h4>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Recent Activities for {player}</h3>
            <div class="table-responsive">
                {act_table}
            </div>
        </div>
        <div class="col-lg-6">
            <h3>Current Holdings for {player}</h3>
            <div class="table-responsive">
                {holding_table}
            </div>
        </div>
    </div>
</div>

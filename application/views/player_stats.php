<div>
    <h1>
        Player Statistics
    </h1>
    <div>
        <p style="float:left">Choose player to view statistics:</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <select name="players" onchange="this.form.submit();">
                {dropdown}
            </select>
        </form>
    </div>
    <h3>
        Recent Activity for {player}
    </h3>
    {act_table}
    <h3>
        Current Holdings for {player}
    </h3>
    {holding_table}
</div>

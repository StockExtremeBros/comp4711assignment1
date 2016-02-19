<div>
    <h1>
        Player Profiles
    </h1>
    <div>
        <form class="ajax-form" role="forms" action="../forms/player_stats_dropdown" method="post">  
            <select name="players" id="players">
                {dropdown}
            </select>
            <button type="submit" class="btn btn-default" id="login-btn">Go to player profile</button>
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

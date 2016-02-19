<div>
<h1>
    {stock} History
</h1>
<form class="ajax-form" role="forms" action="../forms/stockhistorydropdown" method="post">  
    <select name="stocks" id="stocks">
        {dropdown}
    </select>
    <button type="submit" class="btn btn-default" id="login-btn">Go to stock</button>
</form>
<h3>
    Recent Transactions
</h3>
    {trans_table}
<h3>
    Recent Movements
</h3>
    {move_table}
</div>

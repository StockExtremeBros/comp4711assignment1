<div class="container">
    <h1>
        Buy and Sell Stock
    </h1>
    <div>
        <h4>Current equity: {equity}</h4>
        <h4>Cash on hand: {cash}</h4>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Recent Movements</h3>
            <div class="table-responsive">
                {move_table}
            </div>
        </div>
        <div class="col-lg-6">
            <h3>Current Holdings</h3>
            <div class="table-responsive">
                {holding_table}
            </div>
        </div>
    </div>
    <div>
        <h3>Buy Stocks</h3>
        <form action="../gameplay/buy_stock" method="post">
            {stockdropdown}
            <input type="number" name="buy-quantity" placeholder="Quantity" min="0">
            <button type="submit" class="btn btn-default" id="buy-btn">Buy!</button>
        </form>
    </div>
    <div>
        <h3>Sell Stocks</h3>
        <form action="../gameplay/sell_stock" method="post">
            {stockdropdown}
            <input type="number" name="sell-quantity" placeholder="Quantity" min="0">
            <button type="submit" class="btn btn-default" id="sell-btn">Sell!</button>
        </form>
    </div>
</div>

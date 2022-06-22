<div class="search-criteria">
    <form method="get">
        <h2> Refine your Search </h2>
        <h3><input type="hidden" id="hdnPR" value="0">By Price ({{$minPrice.'--'.$maxPrice;}})</h3>
        <div class="">
            <input type="range" id="filterbookprice" name="filterbookprice" min="" max="">
        </div>
        <h3><input type="hidden" id="hdnDiscount" value="0">By Discount</h3>
        <div class="">
            <input type="range" id="filterbookdiscount" name="filterbookdiscount" min="" max="">
        </div>
    </form>
</div>

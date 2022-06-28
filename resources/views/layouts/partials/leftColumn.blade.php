<div class="search-criteria">
    <div class="search-criteria">
        <form action="" method="get" id="bookFilterForm">
            @csrf
            @method('get')
            <h2> Refine your Search </h2>
            <h3>By Price</h3>
            <ul>
                <li class="active"><a href="">All <span> ({{count($books)}})</span></a></li>
                <li><input type="radio" id="bilow-100" name="bprice" value="1" class="me-1"><label for="bilow-100">Below Tk.100</label><br></li>
                <li><input type="radio" id="optiontwo" name="bprice" value="2" class="me-1"><label for="optiontwo">Tk.100 - Tk.500</label><br></li>
                <li><input type="radio" id="optionthree" name="bprice" value="3" class="me-1"><label for="optionthree">Tk.501 - Tk.1000</label><br></li>
                <li><input type="radio" id="optionfour" name="bprice" value="4" class="me-1"><label for="optionfour">Tk.1001 - Tk.2000</label><br></li>
                <li><input type="radio" id="optionfive" name="bprice" value="5" class="me-1"><label for="optionfive">Above Tk.2000</label><br></li>
            </ul>
            <h3>By Discount</h3>
            <ul>
                <li class="active"><a href="">All <span>({{count($books)}})</span></a></li>
                <li><input type="radio" id="disoption1" name="bdiscount" value="1" class="me-1"><label for="">0% - 20%</label><br></li>
                <li><input type="radio" id="disoption2" name="bdiscount" value="2" class="me-1"><label for="">21% - 40%</label><br></li>
                <li><input type="radio" id="disoption3" name="bdiscount" value="3" class="me-1"><label for="">41% - 60%</label><br></li>
                <li><input type="radio" id="disoption4" name="bdiscount" value="4" class="me-1"><label for="">61% - 80%</label><br></li>
                <li><input type="radio" id="disoption5" name="bdiscount" value="5" class="me-1"><label for="">Above 80%</label><br></li>
            </ul>
            <input type="submit" value="Filter" class="btn-red-micro" id="filterbtn">
        </form>
    </div>
</div>

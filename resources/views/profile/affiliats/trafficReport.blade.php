@extends('profile.dashboard-master')


@section('dashboard-wraper')


<div class="contents">
   <h1 id="aff-proreport">
      Product Sales
   </h1>
   <div class="greybox">
      <div class="range">
         Pre-defined Range
      </div>
      <div class="select-range">
         <select name="ctl00$ctl00$phBody$Contents$ddldefineRange" id="ctl00_ctl00_phBody_Contents_ddldefineRange">
            <option value="-1">--Select Range--</option>
            <option value="1">Since Yesterday</option>
            <option value="2">Last 7 Days</option>
            <option value="3">Current Month</option>
            <option value="4">Last 30 Days</option>
         </select>
         <span id="ctl00_ctl00_phBody_Contents_rfvRange" class="error" style="color:Red;display:none;">* Required</span>
      </div>
      <div class="generate">
         <input type="submit" name="ctl00$ctl00$phBody$Contents$btnGenetateRange" value="Generate" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ctl00$phBody$Contents$btnGenetateRange&quot;, &quot;&quot;, true, &quot;vgDateRange&quot;, &quot;&quot;, false, false))" id="ctl00_ctl00_phBody_Contents_btnGenetateRange" class="btn-black">
      </div>
   </div>
   <div class="greybox">
      <div class="range">
         Exact Range (dd/mm/yyyy)
      </div>
      <div class="select-range">
         <input name="ctl00$ctl00$phBody$Contents$txtFromDate" type="text" id="ctl00_ctl00_phBody_Contents_txtFromDate" class="hasDatepicker">
         to
         <input name="ctl00$ctl00$phBody$Contents$txtToDate" type="text" id="ctl00_ctl00_phBody_Contents_txtToDate" class="hasDatepicker">
      </div>
      <div class="generate">
         <input type="submit" name="ctl00$ctl00$phBody$Contents$btnGenerateDate" value="Generate" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ctl00$phBody$Contents$btnGenerateDate&quot;, &quot;&quot;, true, &quot;vgDatewise&quot;, &quot;&quot;, false, false))" id="ctl00_ctl00_phBody_Contents_btnGenerateDate" class="btn-black">
      </div>
      <span id="ctl00_ctl00_phBody_Contents_cvCheckDate" class="error" style="color:Red;display:none;">End date must be greater than start date</span>
   </div>
   <h3>
      Product Sales: <strong>
      <label id="ctl00_ctl00_phBody_Contents_lblDateRange">09 March 2021 to 09 March 2022</label>
      </strong>
   </h3>
   <h4>
      Sales Summary
   </h4>
   <div class="sales-summary">
      <div>
         <table class="report" rules="all" id="ctl00_ctl00_phBody_Contents_gvProductSaleSummary" style="border-style:None;width:100%;border-collapse:collapse;" cellspacing="0" cellpadding="0" border="1">
            <tbody>
               <tr>
                  <th scope="col" align="left">Total Items</th>
                  <th scope="col" align="right">Total Sale</th>
                  <th scope="col" align="right">Commission</th>
                  <th scope="col" align="right">Affiliate Fee</th>
               </tr>
               <tr>
                  <td>0</td>
                  <td align="right">0</td>
                  <td align="right">5%</td>
                  <td align="right">0</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <h4>
      Product Sold
   </h4>
   <div class="product-sold">
      <div>
      </div>
   </div>
   <div class="clearfloat">
   </div>
</div>


@endsection


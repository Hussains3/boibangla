@extends('layouts.master')

@section('content')
<div class="shopping-wrapper">
    <div class="header">
       <a href="/" class="site-logo">
       <img alt="Bookswagon" src="https://www.bookswagon.com/images/logos/shop-logo.png"></a>
       <h1>My Shopping Cart
          <label id="lblCartItems">(0 items)</label>
       </h1>
       <div class="backbtnMobile"><a href="javascript:history.go(-1);">&lt; Back</a></div>
       <div>
       </div>
       <div>
          <div id="currency">
             <div class="currency-lbl">Currency </div>
             <div id="currencydrop">
                <select name="ddlCurrency" onchange="javascript:setTimeout('__doPostBack(\'ddlCurrency\',\'\')', 0)" id="ddlCurrency" class="select" title="Select one" style="z-index: 10; opacity: 0;">
                   <option selected="selected" value="5">INR</option>
                   <option value="1">USD</option>
                </select>
                <span class="select">INR</span>
             </div>
          </div>
       </div>
    </div>
    <div class="tab_container">
       <input type="hidden" name="BookCart$hdnWidth" id="BookCart_hdnWidth" value="1366">
       <div class="tab_content" id="tab1" style="display: block;">
          <div id="BookCart_uplnShopping">
             <div class="full-loader" style="display: none;">
                <div id="loader">
                </div>
             </div>
             <input type="hidden" name="BookCart$hdnTotalQty" id="BookCart_hdnTotalQty" value=" (0 items)">
             <div class="shopping-main">
                <div class="shopping-top">
                   <div id="BookCart_lvCart_divCartMsg" class="shopping-msg" style="display:none;"></div>
                   <div class="shopping-head">
                      <div class="serialno">
                         Sr.#
                      </div>
                      <div class="description">
                         Item Description
                      </div>
                      <div class="quality">
                         Quantity
                      </div>
                      <div class="price">
                         Item Price
                      </div>
                      <div class="total">
                         Total Price
                      </div>
                      <div class="clearfloat">
                      </div>
                   </div>
                   <div class="content">
                      <div class="shopping-content">
                         <div class="serialno">
                            1.
                         </div>
                         <div class="description">
                            <input type="hidden" name="BookCart$lvCart$ctrl0$hdnDeal" id="BookCart_lvCart_ctrl0_hdnDeal" value="False">
                            <div class="cover">
                               <a href="https://www.bookswagon.com/book/things-that-can-cannot-said/9788193284100" target="_parent">
                               <img id="imgProduct " src="https://d2g9wbak88g7ch.cloudfront.net/productimages/image65/notavailable.gif" alt="Things That Can and Cannot be Said" onerror="handleInvalidImages(this,'image65')" width="35px" height="50px"></a>
                            </div>
                            <div class="summary">
                               <input type="hidden" name="BookCart$lvCart$ctrl0$hdnProduct" id="BookCart_lvCart_ctrl0_hdnProduct" value="19664581">
                               <input type="hidden" name="BookCart$lvCart$ctrl0$hdnVendor" id="BookCart_lvCart_ctrl0_hdnVendor" value="63">
                               <input type="hidden" name="BookCart$lvCart$ctrl0$hdnBasketDetailItem" id="BookCart_lvCart_ctrl0_hdnBasketDetailItem" value="1883390">
                               <input type="hidden" name="BookCart$lvCart$ctrl0$hdnPOD" id="BookCart_lvCart_ctrl0_hdnPOD" value="False">
                               <input type="hidden" name="BookCart$lvCart$ctrl0$hdnReturnable" id="BookCart_lvCart_ctrl0_hdnReturnable" value="true">
                               <div class="title">
                                  <label id="BookCart_lvCart_ctrl0_lblProductTitle">Things That Can and Cannot be Said</label>
                               </div>
                               <div class="author-publisher">
                                  <label id="BookCart_lvCart_ctrl0_lblAuthors">by <a href="https://www.bookswagon.com/author/arundhati-roy" target="_parent">Arundhati Roy</a></label>
                               </div>
                               <div class="author-publisher">
                                  <a href="#">
                                     <div class="poptip">
                                        <div class="tooltip-mid1">
                                           <b>Print On Demand (POD) titles :</b> are those which have been especially printed
                                           by the Publisher / Vendor partner only after an order for them has been received.
                                           They are also classified as Non-Returnable.
                                           <br>
                                           <b>Non-Returnable titles : </b>are those which have been classified as Non-Returnable
                                           under any circumstance by International Publishers / Vendor partners.
                                        </div>
                                     </div>
                                  </a>
                               </div>
                            </div>
                         </div>
                         <div class="quality">
                            <input name="BookCart$lvCart$ctrl0$txtQty" type="text" value="1" maxlength="3" id="BookCart_lvCart_ctrl0_txtQty" class="qtytext" onblur="return PageValidate();" autocomplete="off">
                            <input type="image" name="BookCart$lvCart$ctrl0$imgUpdate" id="BookCart_lvCart_ctrl0_imgUpdate" title="Update" class="updateqty" src="images/reload-icon.png" style="border-width:0px;">
                            <span id="BookCart_lvCart_ctrl0_rfvQty" class="error1" style="color:Red;display:none;">Required</span>
                            <span id="BookCart_lvCart_ctrl0_rngQty" class="error1" style="color:Red;display:none;">Invalid</span>
                            <span id="BookCart_lvCart_ctrl0_lblQtyMsg" class="error1" style="display: none;"></span>
                            <input name="BookCart$lvCart$ctrl0$hdnFocus" type="text" id="BookCart_lvCart_ctrl0_hdnFocus" style="width: 0px; height: 0px; border: 0px; padding: 0px;">
                         </div>
                         <div class="price">
                            <div class="list-price">
                               <label id="BookCart_lvCart_ctrl0_lblSalePrice">
                               ₹250</label>
                            </div>
                            <div class="sale-price">
                               <label id="BookCart_lvCart_ctrl0_lblActualPrice">₹163</label>
                            </div>
                         </div>
                         <div class="total">
                            <label id="BookCart_lvCart_ctrl0_lblTotalPrice">₹163</label>
                         </div>
                         <div class="acton">
                            <div class="wishlist">
                               <img alt="" title="" src="images/buttons/moveto.gif"><a id="BookCart_lvCart_ctrl0_btnMovetoWishlist" href="javascript:__doPostBack('BookCart$lvCart$ctrl0$btnMovetoWishlist','')">Move to Wishlist</a>
                            </div>
                            <div class="remove">
                               <img alt="" title="" src="images/buttons/remove-shop.gif"><a id="BookCart_lvCart_ctrl0_imgDelete" imageurl="~/images/buttons/remove-shop.gif" href="javascript:__doPostBack('BookCart$lvCart$ctrl0$imgDelete','')">Remove</a>
                            </div>
                         </div>
                         <div class="clearfloat">
                         </div>
                      </div>
                      <div class="shopping-content">
                         <div class="serialno">
                            2.
                         </div>
                         <div class="description">
                            <input type="hidden" name="BookCart$lvCart$ctrl1$hdnDeal" id="BookCart_lvCart_ctrl1_hdnDeal" value="False">
                            <div class="cover">
                               <a href="https://www.bookswagon.com/book/attack-titan-1-hajime-isayama/9781612620244" target="_parent">
                               <img id="imgProduct " src="https://d2g9wbak88g7ch.cloudfront.net/productimages/image65/244/9781612620244.jpg" alt="Attack on Titan 1" onerror="handleInvalidImages(this,'image65')" width="35px" height="50px"></a>
                            </div>
                            <div class="summary">
                               <input type="hidden" name="BookCart$lvCart$ctrl1$hdnProduct" id="BookCart_lvCart_ctrl1_hdnProduct" value="9565194">
                               <input type="hidden" name="BookCart$lvCart$ctrl1$hdnVendor" id="BookCart_lvCart_ctrl1_hdnVendor" value="46">
                               <input type="hidden" name="BookCart$lvCart$ctrl1$hdnBasketDetailItem" id="BookCart_lvCart_ctrl1_hdnBasketDetailItem" value="1883354">
                               <input type="hidden" name="BookCart$lvCart$ctrl1$hdnPOD" id="BookCart_lvCart_ctrl1_hdnPOD" value="False">
                               <input type="hidden" name="BookCart$lvCart$ctrl1$hdnReturnable" id="BookCart_lvCart_ctrl1_hdnReturnable" value="true">
                               <div class="title">
                                  <label id="BookCart_lvCart_ctrl1_lblProductTitle">Attack on Titan 1</label>
                               </div>
                               <div class="author-publisher">
                                  <label id="BookCart_lvCart_ctrl1_lblAuthors">by <a href="https://www.bookswagon.com/author/hajime-isayama" target="_parent">Hajime Isayama</a></label>
                               </div>
                               <div class="author-publisher">
                                  <a href="#">
                                     <div class="poptip">
                                        <div class="tooltip-mid1">
                                           <b>Print On Demand (POD) titles :</b> are those which have been especially printed
                                           by the Publisher / Vendor partner only after an order for them has been received.
                                           They are also classified as Non-Returnable.
                                           <br>
                                           <b>Non-Returnable titles : </b>are those which have been classified as Non-Returnable
                                           under any circumstance by International Publishers / Vendor partners.
                                        </div>
                                     </div>
                                  </a>
                               </div>
                            </div>
                         </div>
                         <div class="quality">
                            <input name="BookCart$lvCart$ctrl1$txtQty" type="text" value="1" maxlength="3" id="BookCart_lvCart_ctrl1_txtQty" class="qtytext" onblur="return PageValidate();" autocomplete="off">
                            <input type="image" name="BookCart$lvCart$ctrl1$imgUpdate" id="BookCart_lvCart_ctrl1_imgUpdate" title="Update" class="updateqty" src="images/reload-icon.png" style="border-width:0px;">
                            <span id="BookCart_lvCart_ctrl1_rfvQty" class="error1" style="color:Red;display:none;">Required</span>
                            <span id="BookCart_lvCart_ctrl1_rngQty" class="error1" style="color:Red;display:none;">Invalid</span>
                            <span id="BookCart_lvCart_ctrl1_lblQtyMsg" class="error1" style="display: none;"></span>
                            <input name="BookCart$lvCart$ctrl1$hdnFocus" type="text" id="BookCart_lvCart_ctrl1_hdnFocus" style="width: 0px; height: 0px; border: 0px; padding: 0px;">
                         </div>
                         <div class="price">
                            <div class="list-price">
                               <label id="BookCart_lvCart_ctrl1_lblSalePrice">
                               ₹799</label>
                            </div>
                            <div class="sale-price">
                               <label id="BookCart_lvCart_ctrl1_lblActualPrice">₹551</label>
                            </div>
                         </div>
                         <div class="total">
                            <label id="BookCart_lvCart_ctrl1_lblTotalPrice">₹551</label>
                         </div>
                         <div class="acton">
                            <div class="wishlist">
                               <img alt="" title="" src="images/buttons/moveto.gif"><a id="BookCart_lvCart_ctrl1_btnMovetoWishlist" href="javascript:__doPostBack('BookCart$lvCart$ctrl1$btnMovetoWishlist','')">Move to Wishlist</a>
                            </div>
                            <div class="remove">
                               <img alt="" title="" src="images/buttons/remove-shop.gif"><a id="BookCart_lvCart_ctrl1_imgDelete" imageurl="~/images/buttons/remove-shop.gif" href="javascript:__doPostBack('BookCart$lvCart$ctrl1$imgDelete','')">Remove</a>
                            </div>
                         </div>
                         <div class="clearfloat">
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="shopping-bottom">
                <div class="left">
                </div>
                <div class="right">
                   <div class="total-ammount">
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                         <tbody>
                            <tr>
                               <td>
                                  <p>
                                     Total Gross
                                  </p>
                               </td>
                               <td>:
                               </td>
                               <td class="total-gross">
                                  <p>
                                     <label id="BookCart_lvCart_lblTotalGross">₹714</label>
                                  </p>
                               </td>
                               <td class="paddl10">
                                  <label id="BookCart_lvCart_lblShippingTime" class="deliverytime">Ships within 8-10 days.</label>
                               </td>
                            </tr>
                            <tr>
                               <td>
                                  <p>
                                     <label id="BookCart_lvCart_lblShippingText">
                                     Shipping (in India)</label>
                                  </p>
                               </td>
                               <td>
                                  <label id="BookCart_lvCart_lblShippingColon">
                                  :</label>
                               </td>
                               <td class="total-gross">
                                  <p>
                                     <label id="BookCart_lvCart_lblShippingCharges">₹78</label>
                                  </p>
                               </td>
                               <td class="paddl10"></td>
                            </tr>
                            <tr>
                               <td align="right">
                                  <p>
                                  </p>
                               </td>
                               <td>
                               </td>
                               <td class="total-gross">
                                  <p>
                                  </p>
                               </td>
                               <td class="paddl10">
                                  <p>
                                  </p>
                               </td>
                            </tr>
                            <tr>
                               <td align="right">
                                  <p>
                                     <strong>Amount Payable</strong>
                                  </p>
                               </td>
                               <td>:
                               </td>
                               <td>
                                  <p class="gren-amount">
                                     <span>
                                     <label id="BookCart_lvCart_lblNetAmount">₹792</label>
                                     </span>
                                  </p>
                               </td>
                               <td class="paddl10">
                                  <p>
                                     (<a onclick="return ShowPopup();" id="BookCart_lvCart_imgCalculator" href="javascript:__doPostBack('BookCart$lvCart$imgCalculator','')">International Shipping Calculator</a>)
                                  </p>
                                  <div id="BookCart_lvCart_plnShippingCal" class="modalPopup" style="display: none; position: fixed; z-index: 10001;">
                                     <div id="BookCart_lvCart_UpdatePanel1">
                                        <div class="stand-calculator-pop">
                                           <table class="modalpopupsmall" cellspacing="0" cellpadding="0" border="0">
                                              <tbody>
                                                 <tr>
                                                    <td title="country">
                                                       <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                          <tbody>
                                                             <tr>
                                                                <td>
                                                                   <h2>Shipping Calculator
                                                                   </h2>
                                                                </td>
                                                                <td align="right">
                                                                   <input type="image" name="BookCart$lvCart$imgClose" id="BookCart_lvCart_imgClose" src="images/buttons/calc-close-ico.png" style="border-width:0px;">
                                                                </td>
                                                             </tr>
                                                          </tbody>
                                                       </table>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td>
                                                       <p>
                                                          Please select your Shipping Country to see shipping cost
                                                       </p>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td style="font-weight: bold; font-size: 11px; padding: 0 0 5px 0;">Shipping Country:
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td>
                                                       <select name="BookCart$lvCart$ddlCountry" onchange="javascript:setTimeout('__doPostBack(\'BookCart$lvCart$ddlCountry\',\'\')', 0)" id="BookCart_lvCart_ddlCountry" class="ddlcountry-cal">
                                                          <option selected="selected" value="-1">  --Select Country--</option>
                                                          <option value="1">Afghanistan</option>
                                                          <option value="2">Albania</option>
                                                          <option value="3">Algeria</option>
                                                          <option value="4">American Samoa</option>
                                                          <option value="5">Andorra</option>
                                                          <option value="6">Angola</option>
                                                          <option value="7">Anguilla</option>
                                                          <option value="327">Antarctica</option>
                                                          <option value="9">Antigua And Barbuda</option>
                                                          <option value="11">Argentina</option>
                                                          <option value="12">Armenia</option>
                                                          <option value="13">Aruba</option>
                                                          <option value="16">Australia</option>
                                                          <option value="300">Austria</option>
                                                          <option value="18">Azerbaijan</option>
                                                          <option value="314">Bahamas The</option>
                                                          <option value="20">Bahrain</option>
                                                          <option value="271">BALTIC STATES</option>
                                                          <option value="22">Bangladesh</option>
                                                          <option value="23">Barbados</option>
                                                          <option value="25">Belarus</option>
                                                          <option value="26">Belgium</option>
                                                          <option value="27">Belize</option>
                                                          <option value="28">Benin</option>
                                                          <option value="29">Bermuda</option>
                                                          <option value="30">Bhutan</option>
                                                          <option value="31">Bolivia</option>
                                                          <option value="319">Bosnia and Herzegovina</option>
                                                          <option value="33">Botswana</option>
                                                          <option value="331">Bouvet Island</option>
                                                          <option value="35">Brazil</option>
                                                          <option value="328">British Indian Ocean Territory</option>
                                                          <option value="38">Brunei</option>
                                                          <option value="272">Bulgaria</option>
                                                          <option value="40">Burkina Faso</option>
                                                          <option value="42">Burundi</option>
                                                          <option value="43">Cambodia</option>
                                                          <option value="44">Cameroon</option>
                                                          <option value="45">Canada</option>
                                                          <option value="46">Cape Verde</option>
                                                          <option value="47">Cayman Islands</option>
                                                          <option value="48">Central African Republic</option>
                                                          <option value="49">Chad</option>
                                                          <option value="273">CHANNEL ISLANDS</option>
                                                          <option value="50">Chile</option>
                                                          <option value="51">China</option>
                                                          <option value="52">Christmas Island</option>
                                                          <option value="346">Cocos Islands</option>
                                                          <option value="55">Colombia</option>
                                                          <option value="56">Comoros</option>
                                                          <option value="59">Cook Islands</option>
                                                          <option value="61">Costa Rica</option>
                                                          <option value="320">Cote dIvoire</option>
                                                          <option value="274">CRETE</option>
                                                          <option value="348">Croatia</option>
                                                          <option value="64">Cuba</option>
                                                          <option value="65">Cyprus</option>
                                                          <option value="66">Czech Republic</option>
                                                          <option value="303">Democratic Republic Of The Congo</option>
                                                          <option value="276">Denmark</option>
                                                          <option value="68">Djibouti</option>
                                                          <option value="69">Dominica</option>
                                                          <option value="70">Dominican Republic</option>
                                                          <option value="332">East Timor</option>
                                                          <option value="71">Ecuador</option>
                                                          <option value="72">Egypt</option>
                                                          <option value="277">EIRE</option>
                                                          <option value="73">El Salvador</option>
                                                          <option value="74">Equatorial Guinea</option>
                                                          <option value="75">Eritrea</option>
                                                          <option value="76">Estonia</option>
                                                          <option value="77">Ethiopia</option>
                                                          <option value="315">Falkland Islands</option>
                                                          <option value="80">Faroe Islands</option>
                                                          <option value="337">Fiji Islands</option>
                                                          <option value="82">Finland</option>
                                                          <option value="83">France</option>
                                                          <option value="84">French Guiana</option>
                                                          <option value="85">French Polynesia</option>
                                                          <option value="310">French Southern Territories</option>
                                                          <option value="87">Gabon</option>
                                                          <option value="304">Gambia The</option>
                                                          <option value="90">Georgia</option>
                                                          <option value="280">Germany</option>
                                                          <option value="92">Ghana</option>
                                                          <option value="93">Gibraltar</option>
                                                          <option value="281">Greece</option>
                                                          <option value="96">Greenland</option>
                                                          <option value="97">Grenada</option>
                                                          <option value="98">Guadeloupe</option>
                                                          <option value="99">Guam</option>
                                                          <option value="100">Guatemala</option>
                                                          <option value="312">Guernsey and Alderney</option>
                                                          <option value="102">Guinea</option>
                                                          <option value="103">Guinea-Bissau</option>
                                                          <option value="104">Guyana</option>
                                                          <option value="105">Haiti</option>
                                                          <option value="333">Heard and McDonald Islands</option>
                                                          <option value="108">Honduras</option>
                                                          <option value="316">Hong Kong</option>
                                                          <option value="111">Hungary</option>
                                                          <option value="284">Iceland</option>
                                                          <option value="113">India</option>
                                                          <option value="115">Indonesia</option>
                                                          <option value="116">Iran</option>
                                                          <option value="117">Iraq</option>
                                                          <option value="118">Ireland</option>
                                                          <option value="119">Israel</option>
                                                          <option value="120">Italy</option>
                                                          <option value="121">Jamaica</option>
                                                          <option value="285">Japan</option>
                                                          <option value="311">Jersey</option>
                                                          <option value="127">Jordan</option>
                                                          <option value="129">Kazakhstan</option>
                                                          <option value="130">Kenya</option>
                                                          <option value="132">Kiribati</option>
                                                          <option value="135">Kuwait</option>
                                                          <option value="136">Kyrgyzstan</option>
                                                          <option value="137">Laos</option>
                                                          <option value="286">Latvia</option>
                                                          <option value="139">Lebanon</option>
                                                          <option value="140">Lesotho</option>
                                                          <option value="141">Liberia</option>
                                                          <option value="142">Libya</option>
                                                          <option value="287">LICHENSTEIN</option>
                                                          <option value="143">Liechtenstein</option>
                                                          <option value="144">Lithuania</option>
                                                          <option value="145">Luxembourg</option>
                                                          <option value="338">Macau S.A.R.</option>
                                                          <option value="339">Macedonia</option>
                                                          <option value="148">Madagascar</option>
                                                          <option value="149">Malawi</option>
                                                          <option value="150">Malaysia</option>
                                                          <option value="151">Maldives</option>
                                                          <option value="152">Mali</option>
                                                          <option value="288">Malta</option>
                                                          <option value="330">Man (Isle of)</option>
                                                          <option value="155">Marshall Islands</option>
                                                          <option value="156">Martinique</option>
                                                          <option value="157">Mauritania</option>
                                                          <option value="158">Mauritius</option>
                                                          <option value="159">Mayotte</option>
                                                          <option value="160">Mexico</option>
                                                          <option value="269">Micronesia</option>
                                                          <option value="163">Moldova</option>
                                                          <option value="290">Monaco</option>
                                                          <option value="165">Mongolia</option>
                                                          <option value="166">Montserrat</option>
                                                          <option value="167">Morocco</option>
                                                          <option value="168">Mozambique</option>
                                                          <option value="306">Myanmar</option>
                                                          <option value="169">Namibia</option>
                                                          <option value="170">Nauru</option>
                                                          <option value="172">Nepal</option>
                                                          <option value="174">Netherlands Antilles</option>
                                                          <option value="321">Netherlands The</option>
                                                          <option value="175">New Caledonia</option>
                                                          <option value="291">New Zealand</option>
                                                          <option value="177">Nicaragua</option>
                                                          <option value="178">Niger</option>
                                                          <option value="179">Nigeria</option>
                                                          <option value="180">Niue</option>
                                                          <option value="181">Norfolk Island</option>
                                                          <option value="334">North Korea</option>
                                                          <option value="335">Northern Mariana Islands</option>
                                                          <option value="183">Norway</option>
                                                          <option value="184">Oman</option>
                                                          <option value="186">Pakistan</option>
                                                          <option value="187">Palau</option>
                                                          <option value="340">Palestinian Territory Occupied</option>
                                                          <option value="189">Panama</option>
                                                          <option value="190">Papua new Guinea</option>
                                                          <option value="192">Paraguay</option>
                                                          <option value="193">Peru</option>
                                                          <option value="194">Philippines</option>
                                                          <option value="341">Pitcairn Island</option>
                                                          <option value="196">Poland</option>
                                                          <option value="292">Portugal</option>
                                                          <option value="198">Puerto Rico</option>
                                                          <option value="199">Qatar</option>
                                                          <option value="317">Republic Of The Congo</option>
                                                          <option value="200">Reunion</option>
                                                          <option value="201">Romania</option>
                                                          <option value="202">Russia</option>
                                                          <option value="203">Rwanda</option>
                                                          <option value="204">Saint Helena</option>
                                                          <option value="205">Saint Kitts And Nevis</option>
                                                          <option value="206">Saint Lucia</option>
                                                          <option value="313">Saint Pierre and Miquelon</option>
                                                          <option value="307">Saint Vincent And The Grenadines</option>
                                                          <option value="209">Samoa</option>
                                                          <option value="210">San Marino</option>
                                                          <option value="211">Sao Tome and Principe</option>
                                                          <option value="212">Saudi Arabia</option>
                                                          <option value="213">Senegal</option>
                                                          <option value="322">Serbia</option>
                                                          <option value="215">Seychelles</option>
                                                          <option value="216">Sierra Leone</option>
                                                          <option value="295">Singapore</option>
                                                          <option value="218">Slovakia</option>
                                                          <option value="296">Slovenia</option>
                                                          <option value="323">Smaller Territories of the UK</option>
                                                          <option value="220">Solomon Islands</option>
                                                          <option value="221">Somalia</option>
                                                          <option value="293">South Africa</option>
                                                          <option value="308">South Georgia</option>
                                                          <option value="344">South Korea</option>
                                                          <option value="342">South Sudan</option>
                                                          <option value="297">Spain</option>
                                                          <option value="227">Sri Lanka</option>
                                                          <option value="228">Sudan</option>
                                                          <option value="229">Suriname</option>
                                                          <option value="318">Svalbard And Jan Mayen Islands</option>
                                                          <option value="231">Swaziland</option>
                                                          <option value="232">Sweden</option>
                                                          <option value="298">Switzerland</option>
                                                          <option value="234">Syria</option>
                                                          <option value="235">Taiwan</option>
                                                          <option value="236">Tajikistan</option>
                                                          <option value="237">Tanzania</option>
                                                          <option value="238">Thailand</option>
                                                          <option value="239">Togo</option>
                                                          <option value="240">Tokelau</option>
                                                          <option value="241">Tonga</option>
                                                          <option value="242">Trinidad And Tobago</option>
                                                          <option value="244">Tunisia</option>
                                                          <option value="245">Turkey</option>
                                                          <option value="246">Turkmenistan</option>
                                                          <option value="336">Turks And Caicos Islands</option>
                                                          <option value="248">Tuvalu</option>
                                                          <option value="249">Uganda</option>
                                                          <option value="250">Ukraine</option>
                                                          <option value="251">United Arab Emirates</option>
                                                          <option value="252">United Kingdom</option>
                                                          <option value="253">United States</option>
                                                          <option value="309">United States Minor Outlying Islands</option>
                                                          <option value="254">Uruguay</option>
                                                          <option value="255">Uzbekistan</option>
                                                          <option value="256">Vanuatu</option>
                                                          <option value="324">Vatican City State (Holy See)</option>
                                                          <option value="257">Venezuela</option>
                                                          <option value="258">Vietnam</option>
                                                          <option value="343">Virgin Islands (British)</option>
                                                          <option value="325">Virgin Islands (US)</option>
                                                          <option value="326">Wallis And Futuna Islands</option>
                                                          <option value="301">WEST INDIES</option>
                                                          <option value="263">Western Sahara</option>
                                                          <option value="265">Yemen</option>
                                                          <option value="302">Yugoslavia</option>
                                                          <option value="266">Zambia</option>
                                                          <option value="267">Zimbabwe</option>
                                                       </select>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td style="height: 10px"></td>
                                                 </tr>
                                                 <tr>
                                                    <td title="country" style="height: 17px;">
                                                       <label id="BookCart_lvCart_lblShippingCostCal"></label>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td style="height: 10px"></td>
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </div>
                                        <div class="cal-bot-border">
                                        </div>
                                     </div>
                                  </div>
                                  <p></p>
                                  <div data-act-control-type="modalPopupBackground" id="mpeShippingCal_backgroundElement" style="display: none; position: fixed; left: 0px; top: 0px; z-index: 10000;" class="modalBackground"></div>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                      <div class="clearfloat">
                      </div>
                   </div>
                </div>
                <div class="clearfloat">
                </div>
             </div>
             <div class="shopping-action">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                   <tbody>
                      <tr>
                         <td align="left">
                            <a class="demo-link" href="javascript:parent.$.fn.colorbox.close();">
                            <span class="btn-black">&lt;&lt; Shop More items</span></a>
                         </td>
                         <td align="center">
                         </td>
                         <td align="right">
                            <input type="submit" name="BookCart$lvCart$imgPayment" value="Place Order" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;BookCart$lvCart$imgPayment&quot;, &quot;&quot;, true, &quot;vgShoppingCart&quot;, &quot;&quot;, false, false))" id="BookCart_lvCart_imgPayment" class="btn-red">
                         </td>
                      </tr>
                   </tbody>
                </table>
                <!--<div class="right">
                   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                       <tr>
                           <td align="left" style="padding-bottom: 2px;">
                           </td>

                           <td valign="top" style="width: 110px;" align="right">
                           </td>
                       </tr>
                   </table>
                   </div>-->
                <div class="clearfloat">
                </div>
             </div>
          </div>
       </div>
       <script language="javascript" type="text/javascript">
          $(document).ready(function () {
               document.getElementById("BookCart_hdnWidth").value = screen.width;
              // Get the instance of PageRequestManager.
              var prm = Sys.WebForms.PageRequestManager.getInstance();

              // Add initializeRequest and endRequest
              prm.add_initializeRequest(prm_InitializeRequest);
              prm.add_endRequest(prm_EndRequest);

              // Called when async postback begins
              function prm_InitializeRequest(sender, args) {

                  $('.full-loader').fadeIn();
                  // Disable button that caused a postback
                  $get(args._postBackElement.id).disabled = true;
              }

              // Called when async postback ends
              function prm_EndRequest(sender, args) {

                  // get the divImage and hide it again
                  $('.full-loader').fadeOut();
                  // Enable button that caused a postback

                  //if (sender._postBackSettings.sourceElement.id.indexOf('txtQty') > 0) {
                      $("#lblCartItems").html(document.getElementById("BookCart_hdnTotalQty").value);
                 // }
                  if (!sender._postBackSettings.sourceElement) {
                      $get(sender._postBackSettings.sourceElement.id).disabled = false;
                  }
              }


          });
          function CountryLookUp(id) {
              document.getElementById(id).style.display = 'block';

          }
          function CloseDiv(id) {
              document.getElementById(id).style.display = 'none';
          }
          function ShowPopup() {

              //show modal popup window

              $find("mpeShippingCal").show();

              //add event handler to hide the modal popup when user click
              //background of the popup window
              var backgroundElement = $get('mpeShippingCal_backgroundElement');
              if (backgroundElement) $addHandler(backgroundElement,
                  'click', hideModalPopupViaClient);

              return false;
          }

          function hideModalPopupViaClient() {

              //hide modal popup window
              var modalPopupBehavior = $find('mpeShippingCal');

              if (modalPopupBehavior) {
                  modalPopupBehavior.hide();
              }
          }
          function closeModalPopup() {
              $find("mpeShippingCal").hide();
          }

          function PageValidate() {
              if (Page_ClientValidate('vgShoppingCart'))
                  return true;
              else
                  return false;
          }
          function getFlickerSolved() {
              document.getElementById('BookCart_lvCart_plnShippingCal').style.display = 'none';
          }




       </script>
    </div>
</div>
@endsection


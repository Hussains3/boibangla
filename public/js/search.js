function GetSearchCriteria(e, t) {
    var n = "0",
        o = "0",
        l = "0",
        d = "0",
        i = "0",
        r = "0",
        u = "0",
        a = "0",
        m = "0",
        c = "0",
        s = "0";
    n = -1 != t.indexOf("PR") ? t.substring(3) : null != document.getElementById("hdnPR") ? document.getElementById("hdnPR").value : "0", r = -1 != t.indexOf("Stock") ? t.substring(6) : null != document.getElementById("hdnStock") ? document.getElementById("hdnStock").value : "0", o = -1 != t.indexOf("ShippingTime") ? t.substring(13) : null != document.getElementById("hdnST") ? document.getElementById("hdnST").value : "0", i = -1 != t.indexOf("Source") ? t.substring(7) : null != document.getElementById("hdnSource") ? document.getElementById("hdnSource").value : "0", l = -1 != t.indexOf("Binding") ? t.substring(8) : null != document.getElementById("hdnBinding") ? document.getElementById("hdnBinding").value : "0", u = -1 != t.indexOf("Language") ? t.substring(9) : null != document.getElementById("hdnLang") ? document.getElementById("hdnLang").value : "0", d = -1 != t.indexOf("PubYear") ? t.substring(8) : null != document.getElementById("hdnPubYear") ? document.getElementById("hdnPubYear").value : "0", m = -1 != t.indexOf("CategoryID") ? t.substring(11) : null != document.getElementById("hdnCat") ? document.getElementById("hdnCat").value : "0", a = -1 != t.indexOf("Country") ? t.substring(8) : null != document.getElementById("hdnPubYear") ? document.getElementById("hdnPubYear").value : "0", c = -1 != t.indexOf("Discount") ? t.substring(9) : null != document.getElementById("hdnDiscount") ? document.getElementById("hdnDiscount").value : "0", s = -1 != t.indexOf("PrizeId") ? t.substring(8) : null != document.getElementById("hdnPrize") ? document.getElementById("hdnPrize").value : "0";
    SearchResultService.GetSearchID(n, o, l, d, i, search_term, filter, "", r, u, e, a, m, c, s, GetSearchID_callback, OnError)
}

function RemoveSearchCriteria(e, t) {
    var n = "0",
        o = "0",
        l = "0",
        d = "0",
        i = "0",
        r = "0",
        u = "0",
        a = "0";
    n = -1 != t.indexOf("PR") ? t.substring(3) : null != document.getElementById("hdnRemovePR") ? document.getElementById("hdnRemovePR").value : "0", r = -1 != t.indexOf("Stock") ? t.substring(6) : null != document.getElementById("hdnRemoveStock") ? document.getElementById("hdnRemoveStock").value : "0", o = -1 != t.indexOf("ShippingTime") ? t.substring(13) : null != document.getElementById("hdnRemoveST") ? document.getElementById("hdnRemoveST").value : "0", i = -1 != t.indexOf("Source") ? t.substring(7) : null != document.getElementById("hdnRemoveSource") ? document.getElementById("hdnRemoveSource").value : "0", l = -1 != t.indexOf("Binding") ? t.substring(8) : null != document.getElementById("hdnRemoveBinding") ? document.getElementById("hdnRemoveBinding").value : "0", u = -1 != t.indexOf("Language") ? t.substring(9) : null != document.getElementById("hdnRemoveLang") ? document.getElementById("hdnRemoveLang").value : "0", d = -1 != t.indexOf("PubYear") ? t.substring(8) : null != document.getElementById("hdnRemovePubYear") ? document.getElementById("hdnRemovePubYear").value : "0", a = -1 != t.indexOf("Country") ? t.substring(8) : null != document.getElementById("hdnRemoveCountry") ? document.getElementById("hdnRemoveCountry").value : "0";
    SearchResultService.GetSearchID(n, o, l, d, i, search_term, filter, "", r, u, e, a, GetSearchID_callback, OnError)
}

function GetSearchID_callback(e) {
    "*" == filter && (filter = "filter");
    var t = 0;
    if (-1 != e.indexOf(",")) {
        var n = e.split(","),
            o = n[1];
        t = n[0]
    } else t = e;
    "author" == pageType & "author" == filter ? location.href = RootPath + "/author/" + search_term + "?sid=" + t : "publisher" == pageType & "publisher" == filter ? location.href = RootPath + "/publisher/" + search_term + "?sid=" + t : location.href = "books" == o ? RootPath + "/search-books/" + search_term + "/" + filter + "?sid=" + t : "ebooks" == o ? RootPath + "/search-ebooks/" + search_term + "/" + filter + "?sid=" + t : "all" == o ? RootPath + "/search/" + search_term + "/" + filter + "?sid=" + t : "ecategory" == o ? RootPath + "/" + search_term + "/e_" + filter + "?sid=" + t : RootPath + "/" + search_term + "?sid=" + t
}

function OnError(e) {
    "*" == filter && (filter = "filter");
    var t = 0;
    if (-1 != e.indexOf(",")) {
        var n = e.split(","),
            o = n[1];
        t = n[0]
    } else t = e;
    "author" == pageType & "author" == filter ? location.href = RootPath + "/author/" + search_term + "?sid=" + t : "publisher" == pageType & "publisher" == filter ? location.href = RootPath + "/publisher/" + search_term + "?sid=" + t : location.href = "books" == o ? RootPath + "/search-books/" + search_term + "/" + filter + "?sid=" + t : "ebooks" == o ? RootPath + "/search-ebooks/" + search_term + "/" + filter + "?sid=" + t : "all" == o ? RootPath + "/search/" + search_term + "/" + filter + "?sid=" + t : "ecategory" == o ? RootPath + "/" + search_term + "/e_" + filter + "?sid=" + t : "category" == o ? RootPath + "/" + search_term + "/" + filter + "?sid=" + t : RootPath + "/" + search_term + "?sid=" + t
}

function addNotifyMe(e, t, n) {
    SearchResultService.AddNotifyMe(e, t, n, notifyMe_callback, notifyMe_Error)
}

function notifyMe_callback(e) {
    if (-1 != e.indexOf(",")) {
        var t = e.split(","),
            n = t[1];
        id = t[0]
    }
    if ("-1" != id) {
        var o = document.getElementById("divNotify_" + n),
            l = document.getElementById("divNotifyMsg_" + n);
        o.style.display = "none", l.style.display = "block"
    } else {
        (l = document.getElementById("divNotifyMsg_" + n)).innerHTML = "Oops! some error occured.", l.style.display = "block"
    }
}

function notifyMe_Error(e) {
    alert("error" + e)
}

function OpenNotifyEmailPopup(e, t) {
    if ("" == document.getElementById("txtEmail_" + e).value) return document.getElementById("lblNotifyMsg_" + e).innerText = "Required", !1;
    return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(document.getElementById("txtEmail_" + e).value) ? ($(".full-loader").fadeIn(), SearchResultService.VerifyEmailNotifyListing(document.getElementById("txtEmail_" + e).value, e, t, Popup_Success)) : document.getElementById("lblNotifyMsg_" + e).innerText = "Invalid Email", !1
}

function Popup_Success(e) {
    if (-1 != e.indexOf(",")) var t = e.split(","),
        n = t[0],
        o = t[1],
        l = t[2],
        d = t[3];
    if ($(".full-loader").fadeOut(), "0" == n) $(function() {
        $.colorbox({
            href: RootPath + "/verifyemail.aspx?email=" + document.getElementById("txtEmail_" + o).value + "&pid=" + o + "&isbn13=" + l + "&type=notifyme&otp=" + d,
            iframe: !0,
            width: "660px",
            height: "350px",
            fixed: !0,
            scrolling: !1,
            overlayClose: !1,
            escKey: !1,
            onLoad: function() {
                $("#cboxClose").remove()
            }
        })
    });
    else if ("-1" == n) {
        (r = document.getElementById("divNotifyMsg_" + o)).innerHTML = "Oops! some error occured.", r.style.display = "block"
    } else {
        var i = document.getElementById("divNotify_" + o),
            r = document.getElementById("divNotifyMsg_" + o);
        i.style.display = "none", r.style.display = "block"
    }
}

function OnCloseVerifyEmail(e, t) {
    if ("1" == e) {
        var n = document.getElementById("divNotify_" + t),
            o = document.getElementById("divNotifyMsg_" + t);
        n.style.display = "none", o.style.display = "block"
    } else {
        n = document.getElementById("divNotify_" + t), o = document.getElementById("divNotifyMsg_" + t);
        n.style.display = "block", o.style.display = "none"
    }
}

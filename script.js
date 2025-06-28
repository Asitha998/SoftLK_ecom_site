function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// window.addEventListener("scroll", function () {
//     var header = document.getElementById("header0-large");
//     header.classList.toggle("sticky", window.scrollY > 0);
// });

// window.addEventListener("scroll", function () {
//     var header = document.getElementById("header0-small");
//     header.classList.toggle("sticky", window.scrollY > 0);
// });

function clearfilters() {
    var minv = document.getElementById("minvalue");
    var maxv = document.getElementById("maxvalue");

    var afbox = document.getElementById("activefilterbox");

    afbox.classList.remove("d-lg-block", "d-sm-block");
    minv.innerText = 0;
    maxv.innerText = 0;
}

function setfilters() {
    var min = document.getElementById("minpr").value;
    var max = document.getElementById("maxpr").value;

    var minv = document.getElementById("minvalue");
    var maxv = document.getElementById("maxvalue");

    var afbox = document.getElementById("activefilterbox");

    afbox.classList.add("d-lg-block", "d-sm-block");
    minv.innerText = min;
    maxv.innerText = max;

}

function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("s", select.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);

}

var pm;
function viewProductModal(id) {
    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;
function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var vc;
var e;
var n;
// function verifyCategory() {
//     var ncm = document.getElementById("addCategoryVerificationModal");
//     vc = new bootstrap.Modal(ncm);

//     e = document.getElementById("e").value;
//     n = document.getElementById("n").value;

//     var f = new FormData();
//     f.append("email", e);
//     f.append("name", n);

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function () {
//         if (r.readyState == 4) {
//             var t = r.responseText;
//             if (t == "SUCCESS") {
//                 cm.hide();
//                 vc.show();
//             } else {
//                 alert(t);
//             }
//         }
//     }

//     r.open("POST", "addNewCategoryProcess.php", true);
//     r.send(f);
// }

function saveCategory() {
    // var text = document.getElementById("text").value;

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    // f.append("t", text);
    f.append("e", e);
    f.append("n", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                cm.hide();
                window.location.reload();
                alert(t);
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveCategoryProcess.php", true);
    r.send(f);
}

// function trailerView() {
// alert("playVideo");
//     document.getElementById("trailer").classList.toggle("d-none");
// }

function trailerView() {
    var trailerDiv = document.getElementById("trailer");
    var iframe = trailerDiv.querySelector("iframe");

    if (!trailerDiv.classList.contains("d-none")) {
        // Stop the video playback by resetting the src attribute
        iframe.src = iframe.src;
    }

    trailerDiv.classList.toggle("d-none");
}


function deleteFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                alert("Product removed from cart.");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    r.send();

}

function changeStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "btn btn-warning fw-bold mt-1 mb-1";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold mt-1 mb-1";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold mt-1 mb-1";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "btn btn-danger fw-bold mt-1 mb-1 disabled";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();

}

function searchInvoiceId() {
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "empty") {
                window.location.reload();
            } else {
                document.getElementById("viewArea").innerHTML = t;
            }
        }
    }

    r.open("GET", "searchInvoiceIdProcess.php?id=" + txt, true);
    r.send();
}

function findSellings() {
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "0") {
                alert("Please select a date to search.")
            } else {
                document.getElementById("viewArea").innerHTML = t;
            }
        }
    }

    r.open("GET", "findSellingProcess.php?f=" + from + "&t=" + to, true);
    r.send();
}

var cam;
function contactAdmin(email) {
    var m = document.getElementById("contactAdmin");
    cam = new bootstrap.Modal(m);
    cam.show();
}

function sendAdminMsg() {
    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t", txt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "sendAdminMessageProcess.php", true);
    r.send(f);
}

function loadProductsByCat(x, cId, cName) {

    // alert("done"+x+cId+cName);
    // document.getElementById("vag").classList.add("d-none");

    var f = new FormData();

    var min = document.getElementById("minvalue").innerText;
    var max = document.getElementById("maxvalue").innerText;

    f.append("cid", cId);
    f.append("cname", cName);
    f.append("page", x);
    f.append("min", min);
    f.append("max", max);

    // alert(min,max);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productbox").innerHTML = t;
            // alert(t);

            var cate = document.getElementById("cate");
            cate.innerText = cName;
        }
    }

    r.open("POST", "loadProductProcess.php", true);
    r.send(f);

}

function loadProductsByBrand(x, bId, bName) {

    // alert("done"+x+cId+cName);
    // document.getElementById("vag").classList.add("d-none");

    var f = new FormData();

    var min = document.getElementById("minvalue").innerText;
    var max = document.getElementById("maxvalue").innerText;

    f.append("bid", bId);
    f.append("bname", bName);
    f.append("page", x);
    f.append("min", min);
    f.append("max", max);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productbox").innerHTML = t;
            // alert(t);

            var cate = document.getElementById("cate");
            cate.innerText = bName;
        }
    }

    r.open("POST", "loadProductByBrandProcess.php", true);
    r.send(f);

}

// function signUp() {
//     var signUpBox = document.getElementById("signUpBox");
//     var signInBox = document.getElementById("signInBox");

//     signUpBox.classList.toggle("d-none");
//     signInBox.classList.toggle("d-none");
// }

// function signout() {
//     var signedIn1 = document.getElementById("signedIn1");
//     var signedIn2 = document.getElementById("signedIn2");

//     var signedOut = document.getElementById("signedOut");

//     signedIn1.className = "d-none";
//     signedIn2.className = "d-none";

//     signedOut.className = "text-lg-start fw-bold text-primary Scurser";
// }

function signUp() {

    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "SUCCESS") {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msg").className = "bi bi-patch-check-fill";
                alert("Successfully Signed Up.");
                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("alertdiv").className = "alert alert-danger";
                document.getElementById("msg").className = "bi bi-x-octagon-fill";
            }
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);

}



function signIn() {

    var email = document.getElementById("e2");
    var password = document.getElementById("p2");
    var rememberme = document.getElementById("rememberme");

    var form2 = new FormData();
    form2.append("e", email.value);
    form2.append("p", password.value);
    form2.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(form2);

}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {

                // window.location = "home.php";
                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signOutProcess.php", true);
    r.send();

}

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else if (t == "Unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "userBlockProcess.php?email=" + email, true);
    r.send();

}

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("pb" + id).innerHTML = "Unblock";
                document.getElementById("pb" + id).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("pb" + id).innerHTML = "Block";
                document.getElementById("pb" + id).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();

}

var bm;
function forgotPassword() {

    var m = document.getElementById("forgotPasswordModal");
    bm = new bootstrap.Modal(m);
    bm.show();
}

function showPassword1() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2() {

    var i = document.getElementById("rnp");
    var eye = document.getElementById("ee2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }
}

function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                document.getElementById("heart" + id).className = "bi bi-heart-fill text-white";
            } else if (t == "added") {
                document.getElementById("heart" + id).className = "bi bi-heart-fill text-danger";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

var av;
function adminVerificationCode() {
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                var aVerModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(aVerModal);
                av.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function adminVerify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "verifyProcess.php?v=" + verification.value, true);
    r.send();
}

function removeFromWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    r.send();

}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function qty_inc(x) {
    var input = document.getElementById("qtyInput");

    // var newValue = parseInt(input.value) + 1;
    // input.value = newValue.toString();

    if (input.value < x) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
    } else {
        // alert("Maximum quantity has achieved.");
        input.value = x;
    }
}

function qty_dec() {
    var input = document.getElementById("qtyInput");
    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
    } else {
        // alert("Minimun quantity has achieved.");
        input.value = 1;
    }
}

function checkValue() {
    var input = document.getElementById("qtyInput");

    if (input.value <= 0) {
        alert("Quantity must be 1 or more.");
        input.value = 1;
    }
}

function changeProductImage() {
    var image = document.getElementById("imageUploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert("Please select 3 or less than 3 images.");
        }

    }
}

function load_brand() {

    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;
            load_type();

        }
    }

    r.open("GET", "loadBrand.php?c=" + category, true);
    r.send();

}

function changeImage() {
    var view = document.getElementById("viewImg");//img tag
    var file = document.getElementById("profileimg");//file chooser

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("mb", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("pr", province.value);
    f.append("ds", district.value);
    f.append("ct", city.value);
    f.append("pc", pcode.value);

    if (image.files.length == 0) {

        var confirmation = confirm("Are you sure You don't want to update Profile Image?");

        if (confirmation) {
            alert("you have not selected any image.");
        }

    } else {
        f.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "SUCCESS") {
                alert("Profile Updated");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function load_type() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("type").innerHTML = t;
        }
    }

    r.open("GET", "loadType.php", true);
    r.send();
}

function sort1(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var type = "0";

    if (document.getElementById("b").checked) {
        type = "1";
    } else if (document.getElementById("u").checked) {
        type = "2";
    }

    var f = new FormData();

    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", type);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function clearSort() {
    window.location.reload();
}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "SUCCESS") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendProductIdProcess.php?id=" + id, true);
    r.send();

}

// function convertAndEmbed() {
//     var urlInput = document.getElementById('link').value;
//     var videoId = getYouTubeVideoId(urlInput);
//     if (videoId) {
//         var embedUrl = `https://www.youtube.com/embed/${videoId}`;

//     } else {
//         alert('Please enter a valid YouTube URL.');
//     }
// }

function getEmbedUrl(url) {
    try {
        var urlObj = new URL(url);
        if (urlObj.hostname === 'www.youtube.com' && urlObj.pathname === '/watch' && urlObj.searchParams.get('v')) {
            return `https://www.youtube.com/embed/${urlObj.searchParams.get('v')}`;
        } else if (urlObj.hostname === 'youtu.be') {
            return `https://www.youtube.com/embed/${urlObj.pathname.substring(1)}`;
        } else if (urlObj.hostname === 'www.youtube.com' && urlObj.pathname.startsWith('/embed/')) {
            return url; // Already an embed URL
        }

    } catch (error) {
        return null;
    }
    return null; // Invalid or unsupported URL
}

function saveProductImage() {

    var title = document.getElementById("t");
    var image = document.getElementById("imageUploader");

    var f = new FormData();

    f.append("t", title.value);

    var image_count = image.files.length;

    for (var x = 0; x < image_count; x++) {
        f.append("i" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "Product images has been updated") {
                alert("Product images have been updated");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductImgProcess.php", true);
    r.send(f);
}

function updateProduct() {
    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var delivery_withing_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var cost = document.getElementById("cost");
    // var image = document.getElementById("imageUploader");
    var link = "";

    //converting youtube url to embed format
    const urlInput = document.getElementById('link').value;
    const embedUrl = getEmbedUrl(urlInput);
    if (embedUrl) {
        link = embedUrl;
        // alert(link);
    } else {
        link = "invalid";
        // alert(link);
    }

    var f = new FormData();

    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", delivery_withing_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("link", link);

    // var image_count = image.files.length;

    // for (var x = 0; x < image_count; x++) {
    //     f.append("i" + x, image.files[x]);
    // }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "Product updated") {
                alert("Product has been updated");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);

}

function changeProductImage() {
    var image = document.getElementById("imageUploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert("Please select 3 or less than 3 images.");
        }

    }
}

function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var type = document.getElementById("type");
    var title = document.getElementById("title");
    // var link = document.getElementById("link");

    //converting youtube url to embed format
    var urlInput = document.getElementById('link').value;
    var videoId = getYouTubeVideoId(urlInput);
    if (videoId) {
        var embedUrl = `https://www.youtube.com/embed/${videoId}`;

    } else {
        alert('Please enter a valid YouTube URL.');
    }

    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageUploader");

    var f = new FormData();

    f.append("ca", category.value);
    f.append("br", brand.value);
    f.append("ty", type.value);
    f.append("t", title.value);
    f.append("link", embedUrl);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product image saved successfully") {
                alert("Product added Successlly.");
                window.location.reload();
            } else {
                alert(t);
            }
        }

    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}

function payNow(id) {
    var qty = document.getElementById("qtyInput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please Log in to continue");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your profile first");
                window.location = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221508",    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": "Colombo",
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;

    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}

// price slider

window.onload = function () {
    slideMin();
    slideMax();
};

const minVal = document.querySelector(".min-val");
const maxVal = document.querySelector(".max-val");
const priceInputMin = document.querySelector(".min-input");
const priceInputMax = document.querySelector(".max-input");
const minTooltip = document.querySelector(".min-tooltip");
const maxTooltip = document.querySelector(".max-tooltip");
const minGap = 1500;
const range = document.querySelector(".slider-track");
const sliderMinValue = parseInt(minVal.min);
const sliderMaxValue = parseInt(maxVal.max);

function slideMin() {
    let gap = parseInt(maxVal.value) - parseInt(minVal.value);
    if (gap <= minGap) {
        minVal.value = parseInt(maxVal.value) - minGap;
    }
    minTooltip.innerHTML = "$" + minVal.value;
    priceInputMin.value = minVal.value;
    setArea();
}

function slideMax() {
    let gap = parseInt(maxVal.value) - parseInt(minVal.value);
    if (gap <= minGap) {
        maxVal.value = parseInt(minVal.value) + minGap;
    }
    maxTooltip.innerHTML = "$" + maxVal.value;
    priceInputMax.value = maxVal.value;
    setArea();
}

function setArea() {
    range.style.left = (minVal.value / sliderMaxValue) * 100 + "%";
    minTooltip.style.left = (minVal.value / sliderMaxValue) * 100 + "%";
    range.style.right = 100 - (maxVal.value / sliderMaxValue) * 100 + "%";
    maxTooltip.style.right = 100 - (maxVal.value / sliderMaxValue) * 100 + "%";
}

function setMinInput() {
    let minPrice = parseInt(priceInputMin.value);
    if (minPrice < sliderMinValue) {
        priceInputMin.value = sliderMinValue;
    }
    minVal.value = priceInputMin.value;
    slideMin();
}

function setMaxInput() {
    let maxPrice = parseInt(priceInputMax.value);
    if (maxPrice < sliderMaxValue) {
        priceInputMax.value = sliderMaxValue;
    }
    maxVal.value = priceInputMax.value;
    slideMax();
}




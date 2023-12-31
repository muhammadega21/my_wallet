// sidebar
$(document).ready(function () {
    $(".bar").click(function () {
        $(".sidebar").toggleClass("active");
        $(".navbar").toggleClass("pointer-events-none");
        $(".content").toggleClass("pointer-events-none");
    });
});

// menu
$(document).ready(function () {
    $(".menu-name").each(function () {
        $(this).click(function () {
            const menu = $(this);
            if ($(".sidebar").hasClass("active")) {
                $(".bar").click(function () {
                    $(".sidebar .side-list .menu ul li").css(
                        "transition",
                        "all 0.10s ease-out"
                    );
                    menu.parent().removeClass("active");
                });
            }
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
            } else {
                $(".menu-name").each(function () {
                    $(this).parent().removeClass("active");
                });
                $(".sidebar .side-list .menu ul li").css(
                    "transition",
                    "all 0.2s ease-out"
                );
                $(this).parent().addClass("active");
            }
        });
    });
});

// dropdown
$(document).ready(function () {
    $(".nav-right .img").click(function () {
        $(".navbar .dropdown").toggleClass("active");
    });
});

$(document).ready(function () {
    $(document).click(function (e) {
        if ($(".navbar .dropdown").hasClass("active")) {
            if (!$(".nav-right .img")[0].contains(e.target)) {
                $(".navbar .dropdown").removeClass("active");
            }
        }
    });
});

// Password
$(document).ready(function () {
    $("#showPassword").click(function () {
        if ($(this).hasClass("bxs-show")) {
            $(this).removeClass("bxs-show");
            $(this).addClass("bxs-hide");
            $("#password").attr("type", "text");
        } else {
            $(this).removeClass("bxs-hide");
            $(this).addClass("bxs-show");
            $("#password").attr("type", "password");
        }
    });
});

// ID User
$(document).ready(function () {
    if ($("#id_user")) {
        const val = Math.floor(1000 + Math.random() * 9000);
        $("#id_user").val(val);
    }
});

// Select2
$(document).ready(function () {
    $("#rekening_id").select2({
        placeholder: "Pilih Rekening / E-Wallet",
        allowClear: true,
    });
});

// Total Harga

$(document).ready(function () {
    $("#item_price").keyup(function (e) {
        let qty = $("#item_qty").val();
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
        if (qty > 1) {
            $("#item_total").val($(this).val() * qty);
        } else {
            $("#item_qty").val(1);
            $("#item_total").val($(this).val());
        }
    });
    $("#item_qty").keyup(function () {
        let num = $(this).val();
        $("#item_total").val($("#item_price").val() * $(this).val());
        $(".bx-minus").click(function () {
            if (num > 1) {
                $("#item_qty").val(--num);
                $("#item_total").val($("#item_price").val() * num);
            }
        });
        $(".bx-plus").click(function () {
            $("#item_qty").val(++num);
            $("#item_total").val($("#item_price").val() * num);
        });
    });
});

// Rekening
$(document).on("change", "#metode", function (e) {
    const rekening = $(".rekening");
    if (this.options[e.target.selectedIndex].text != "Dompet") {
        rekening.removeClass("invisible");
        $("#rekening_id").attr("required", true);
        $("#wallet_id").val("");
    } else {
        $("#wallet_id").val($("#wallet_value").val());
        if (!$(rekening).hasClass("invisible")) {
            $("#rekening_id").attr("required", false);
            rekening.addClass("invisible");
        }
    }
});

// create-popup
$(document).ready(function () {
    $(".add-popup").click(function () {
        $(".create-popup").addClass("active");
        $(".close").click(function () {
            $(".create-popup").removeClass("active");
        });
    });
});

// addFriend-popup
$(document).ready(function () {
    $(".addFriend-btn").click(function () {
        $(".addFriend-popup").addClass("active");
        $(".close").click(function () {
            $(".addFriend-popup").removeClass("active");
            $("#friendUsername").val("");
            $("#friendID").val("");
        });
    });
});

// edit-popup
$(document).ready(function () {
    $(".edit-popup").each(function () {
        $(this).click(function () {
            const card = $(this).closest(".card");
            const popup = $(".update-popup");
            const saldo = card.find(".saldo").text();
            let numSaldo = saldo.replace(/\D/g, "");
            numSaldo = numSaldo.slice(0, -2);

            popup.addClass("active");
            popup.find("#id").val(card.find(".rekening_id").text());
            popup.find("#bank").val(card.find(".rekening_name").text());
            popup.find("#number").val(card.find(".rekening_number").text());
            popup.find("#money_total").val(numSaldo);

            // form url
            popup
                .find("#formUpdate")
                .attr(
                    "action",
                    "http://localhost:8000/rekening/" +
                        card.find(".rekening_id").text()
                );
            popup
                .find("#formDelete")
                .attr(
                    "action",
                    "http://localhost:8000/rekening/" +
                        card.find(".rekening_id").text()
                );
            $(".close").click(function () {
                $(".update-popup").removeClass("active");
            });
        });
    });
});

// saldo
$(document).ready(function () {
    $(".saldo").each(function () {
        const saldo = $(this).text();
        const rp = saldo.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $(this).text("Rp " + rp + ",00");
    });
});

// delete confirm
document.querySelectorAll("#delete").forEach((button) => {
    button.addEventListener("click", (e) => {
        const form = e.target.closest("form");
        e.preventDefault();
        swal.fire({
            title: "Konfirmasi",
            text: "Yakin ingin menghapus?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal",
        }).then(function (result) {
            if (result.value) {
                form.submit();
            }
        });
    });
});

// img
$(document).ready(function () {
    $("#image").change(function () {
        const imgPreview = $(".img-preview");
        const updateBtn = $("#btnUpdate");
        const oFReader = new FileReader();

        oFReader.readAsDataURL(this.files[0]);

        oFReader.onload = function (oFReader) {
            imgPreview.attr("src", oFReader.target.result);
            imgPreview.css("display", "block");
            updateBtn.css("display", "block");
        };
    });
});

// search friend
$(document).ready(function () {
    $("#friendUsername" && "#friendID").on("keyup", function () {
        let username = $("#friendUsername").val();
        let id_user = $("#friendID").val();
        $.ajax({
            type: "get",
            url: "search",
            data: {
                _token: $('input[name="_token"]').val(),
                username: username,
                id_user: id_user,
            },
            success: function (data) {
                $(".friendList").html(data);
            },
        });
    });
});
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

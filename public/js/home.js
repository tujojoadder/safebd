/* image slider */
document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.slider-image');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;
        const slideInterval = 3000; // 3 seconds

        function showSlide(index) {
            // Remove active class from all
            images.forEach(img => img.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add active class to current
            images[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % images.length;
            showSlide(currentSlide);
        }

        // Auto slide
        let autoSlide = setInterval(nextSlide, slideInterval);

        // Dot click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);

                // Reset auto slide
                clearInterval(autoSlide);
                autoSlide = setInterval(nextSlide, slideInterval);
            });
        });

        // Pause on hover
        const slider = document.querySelector('.image-slider');
        slider.addEventListener('mouseenter', () => {
            clearInterval(autoSlide);
        });

        slider.addEventListener('mouseleave', () => {
            autoSlide = setInterval(nextSlide, slideInterval);
        });
    });







// Scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px",
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

document
    .querySelectorAll(".blood-card, .info-card, .profile-card, .gallery-item")
    .forEach((el) => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "all 0.6s ease";
        observer.observe(el);
    });

$(function () {
    // AJAX - Load Districts when Division is selected
    $("#division_id").on("change", function () {
        const divisionId = $(this).val();
        const districtSelect = $("#district_id");
        const upazilaSelect = $("#upazila_id");

        // Reset district and upazila
        districtSelect.html('<option value="">লোড হচ্ছে...</option>');
        upazilaSelect.html(
            '<option value="">প্রথমে জেলা নির্বাচন করুন</option>'
        );

        if (divisionId) {
            $.ajax({
                url: `/safebd/get-districts/${divisionId}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    districtSelect.html(
                        '<option value="">জেলা নির্বাচন করুন</option>'
                    );
                    $.each(data, function (key, district) {
                        districtSelect.append(
                            `<option value="${district.id}">${district.name_en} (${district.bn_name})</option>`
                        );
                    });
                },
                error: function () {
                    districtSelect.html(
                        '<option value="">জেলা লোড করতে ব্যর্থ</option>'
                    );
                },
            });
        } else {
            districtSelect.html(
                '<option value="">প্রথমে বিভাগ নির্বাচন করুন</option>'
            );
        }
    });

    // AJAX - Load Upazilas when District is selected
    $("#district_id").on("change", function () {
        const districtId = $(this).val();
        const upazilaSelect = $("#upazila_id");

        // Reset upazila
        upazilaSelect.html('<option value="">লোড হচ্ছে...</option>');

        if (districtId) {
            $.ajax({
                url: `/safebd/get-upazilas/${districtId}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    upazilaSelect.html(
                        '<option value="">থানা/উপজেলা নির্বাচন করুন</option>'
                    );
                    $.each(data, function (key, upazila) {
                        upazilaSelect.append(
                            `<option value="${upazila.id}">${upazila.name_en} (${upazila.bn_name})</option>`
                        );
                    });
                },
                error: function () {
                    upazilaSelect.html(
                        '<option value="">উপজেলা লোড করতে ব্যর্থ</option>'
                    );
                },
            });
        } else {
            upazilaSelect.html(
                '<option value="">প্রথমে জেলা নির্বাচন করুন</option>'
            );
        }
    });
});








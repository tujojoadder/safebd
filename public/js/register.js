 $(function() {
            // jQuery Datepicker initialization
            $("#dateOfBirth").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                yearRange: "1950:2025",

            });

            // AJAX - Load Districts when Division is selected
            $('#division_id').on('change', function() {
                const divisionId = $(this).val();
                const districtSelect = $('#district_id');
                const upazilaSelect = $('#upazila_id');

                // Reset district and upazila
                districtSelect.html('<option value="">লোড হচ্ছে...</option>');
                upazilaSelect.html('<option value="">প্রথমে জেলা নির্বাচন করুন</option>');

                if (divisionId) {
                    $.ajax({
                        url: `/safebd/get-districts/${divisionId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            districtSelect.html('<option value="">জেলা নির্বাচন করুন</option>');
                            $.each(data, function(key, district) {
                                districtSelect.append(
                                    `<option value="${district.id}">${district.name_bn}</option>`
                                );
                            });
                        },
                        error: function() {
                            districtSelect.html(
                                '<option value="">জেলা লোড করতে ব্যর্থ</option>');
                        }
                    });
                } else {
                    districtSelect.html('<option value="">প্রথমে বিভাগ নির্বাচন করুন</option>');
                }
            });

            // AJAX - Load Upazilas when District is selected
            $('#district_id').on('change', function() {
                const districtId = $(this).val();
                const upazilaSelect = $('#upazila_id');

                // Reset upazila
                upazilaSelect.html('<option value="">লোড হচ্ছে...</option>');

                if (districtId) {
                    $.ajax({
                        url: `/safebd/get-upazilas/${districtId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            upazilaSelect.html(
                                '<option value="">থানা/উপজেলা নির্বাচন করুন</option>');
                            $.each(data, function(key, upazila) {
                                upazilaSelect.append(
                                    `<option value="${upazila.id}">${upazila.name_bn}</option>`
                                );
                            });
                        },
                        error: function() {
                            upazilaSelect.html(
                                '<option value="">উপজেলা লোড করতে ব্যর্থ</option>');
                        }
                    });
                } else {
                    upazilaSelect.html('<option value="">প্রথমে জেলা নির্বাচন করুন</option>');
                }
            });
        });
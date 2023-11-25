function populateProvinces() {
  const countrySelect = document.getElementById("country");
  const provinceSelect = document.getElementById("province");

  const provincesData = {
    'vietnam': ["Ha Long", "Nha Trang", "Vung Tau", "Da Nang", "Hai Phong"],
    'china': ["Beijing", "Shanghai", "Guangdong", "Sichuan", "Fujian"],
    'japan': ["Fukuoka", "Hyogo", "Okayama", "Hokkaido", "Chiba"],
  };

  const selectedCountry = countrySelect.value;
  provinceSelect.innerHTML = '<option value="">Select province</option>';

  if (selectedCountry) {
    const provinces = provincesData[selectedCountry];
    for (let i = 0; i < provinces.length; i++) {
      const option = document.createElement("option");
      option.value = provinces[i];
      option.text = provinces[i];
      provinceSelect.appendChild(option);
    }
  }
}

$(document).ready(function() {
    $('#locationForm').submit(function(event) {
        event.preventDefault();

        var selectedCountry = $('#country').val();
        var selectedProvince = $('#province').val();

        $.ajax({
            url: 'action/process_location.php', 
            method: 'POST',
            data: { country: selectedCountry, province: selectedProvince },
            success: function(response) {
                console.log(response);
            },
            error: function() {
                alert('Error submitting location');
            }
        });
    });
});

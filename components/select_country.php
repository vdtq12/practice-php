<h3 class="mt-4">Location List</h3>
<form id="locationForm">
    <label for="country">Country: </label>
    <select id="country" onchange="populateProvinces()">
        <option value="">Select Country</option>
        <option value="vietnam">Viet Nam</option>
        <option value="china">China</option>
        <option value="japan">Japan</option>
    </select>

    <label for="province">Province: </label>
    <select id="province">
        <option value="">Select province</option>
    </select>

    <input type="submit" value="Find">
</form>
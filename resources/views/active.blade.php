<form action="{{ route('license.activate') }}" method="POST">
    @csrf
    <label>License Key ထည့်ပါ:</label>
    <input type="text" name="license_key" placeholder="XXXX-XXXX-XXXX-XXXX" required>
    <button type="submit">Activate လုပ်မည်</button>
</form>
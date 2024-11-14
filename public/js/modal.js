
function openModal(id) {

    document.getElementById('detailModal').classList.remove('hidden');

    fetch(`/barangmasuk/${id}/details`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalBody').innerHTML = `
                <p><strong>Kode Barang:</strong> ${data.kode_barang}</p>
                <p><strong>Nama Barang:</strong> ${data.nama_barang}</p>
                <p><strong>Kuantiti:</strong> ${data.kuantiti}</p>
                <p><strong>Vendor:</strong> ${data.vendor}</p>
                <p><strong>Kategori:</strong> ${data.kategori}</p>
                <p><strong>Harga Beli:</strong> ${data.harga_beli}</p>
            `;
            document.getElementById('detailModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching data:', error));
}
    // Function to close the modal
    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }


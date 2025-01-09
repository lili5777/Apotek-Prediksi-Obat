#include <iostream>
using namespace std;
int main()
{
    int jumlahSKS, satuanHonor, jumlahmatkul, jumlahPertemuan[jumlahmatkul], sksPerMataKuliah[jumlahmatkul];
    double honor, pajak, totalBayar;
    string nama, golongan, pendidikan, matkul[jumlahmatkul];

    // Input data
    cout << "Masukkan Nama Dosen: ";
    getline(cin, nama);
    cout << "Masukkan Golongan (contoh: IIIa): ";
    cin >> golongan;
    cout << "Masukkan Pendidikan (S1/S2/S3): ";
    cin >> pendidikan;
    cout << "Masukan Jumlah MataKuliah : ";
    cin >> jumlahmatkul;
    for (int a = 0; a < jumlahmatkul; a++)
    {
        cout << "Masukkan Nama Matkul: ";
        cin >> matkul[a];
        cout << "Masukkan Jumlah Pertemuan: ";
        cin >> jumlahPertemuan[a];
        cout << "Masukkan SKS per Mata Kuliah: ";
        cin >> sksPerMataKuliah[a];

        // Menghitung jumlah SKS dan satuan honor
        jumlahSKS += jumlahPertemuan[a] * sksPerMataKuliah[a];
    }

    
    if (golongan == "IIIa" || golongan == "IIIb")
    {
        if (pendidikan == "S1")
            satuanHonor = 70000;
        if (pendidikan == "S2")
            satuanHonor = 80000;
        if (pendidikan == "S3")
            satuanHonor = 95000;
    }
    else if (golongan == "IIIc" || golongan == "IIId")
    {
        if (pendidikan == "S1")
            satuanHonor = 75000;
        if (pendidikan == "S2")
            satuanHonor = 86000;
        if (pendidikan == "S3")
            satuanHonor = 120000;
    }
    else if (golongan == "VIa" || golongan == "VIb")
    {
        if (pendidikan == "S2")
            satuanHonor = 92000;
        if (pendidikan == "S3")
            satuanHonor = 150000;
    }
    else if (golongan == "VIc" || golongan == "VId")
    {
        if (pendidikan == "S2")
            satuanHonor = 120000;
        if (pendidikan == "S3")
            satuanHonor = 170000;
    }
    else
    {
        satuanHonor = 0;
    }

    // Menghitung honor, pajak, dan total bayar
    int beban=24;
    honor = (jumlahSKS-beban) * satuanHonor;
    pajak = 0.05 * honor;
    totalBayar = honor - pajak;

    // Output hasil
    cout << "\n=== Honor Dosen ===" << endl;
    cout << "Nama: " << nama << endl;
    cout << "Golongan: " << golongan << endl;
    cout << "Pendidikan: " << pendidikan << endl;
    cout << "Jumlah SKS: " << jumlahSKS << endl;
    cout << "Honor: Rp" << honor << endl;
    cout << "Pajak: Rp" << pajak << endl;
    cout << "Total Bayar: Rp" << totalBayar << endl;

    return 0;
}

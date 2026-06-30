<x-mail::message>
# 🎉 Donasi Baru Masuk!

Assalamualaikum Admin,

Ada donasi baru yang masuk ke sistem TPQ Al-Mukharijin.

<x-mail::panel>
**Detail Donasi:**

- **Donatur:** {{ $donasi->nama_donatur }}
- **Program:** {{ $program->nama_program }}
- **Jumlah:** Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
- **Metode:** {{ strtoupper($donasi->metode) }}
- **Status:** {{ ucfirst($donasi->status_bayar) }}
- **No. Referensi:** {{ $donasi->midtrans_id ?? '#'.str_pad($donasi->id_donasi, 6, '0', STR_PAD_LEFT) }}
- **Waktu:** {{ $donasi->created_at->format('d F Y, H:i') }} WIB
</x-mail::panel>

Silakan login ke panel admin untuk memverifikasi donasi ini.

<x-mail::button :url="url('/admin/donasi')" color="success">
Lihat di Panel Admin
</x-mail::button>

Jazakallah khairan,<br>
**Sistem TPQ Al-Mukharijin**
</x-mail::message>
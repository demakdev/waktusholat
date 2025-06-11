<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DisplayController extends Controller
{
    public function index(): Response{

        //nanti diambil dari database Masjid Sesuai data User
        $mosqueName = 'Masjid Al-Falah';
        $address = "Banjarsari, Gajah";
        $city = 'Demak';
        $mosqueAddress = $address.', '.$city;
        $country = 'Indonesia';
        $method = 20;

        $template = 'Modern';// nanti bisa ambil dari database setting, pilihannya sesuai templatye yang tersedia
        $runningText = 'Selamat datang di Masjid Al-Falah. Jaga kebersihan dan ketenangan masjid.'; // nanti bisa ambil dari database running_text
        $embedVideoId = 'nJrzkPxTRbI'; // ID video youtube
        

        $response = Http::get("https://api.aladhan.com/v1/timingsByCity", [
            'city' => $city,
            'country' => $country,
            'method' => $method,
            'tune' => '3,3,3,3,3,3,3,3,3',
        ]);

        if ($response->failed()) {
            // Bisa redirect atau tampilkan error khusus di UI
            abort(500, 'Gagal mengambil data jadwal shalat');
        }

        $data = $response->json()['data'];

        // Pilih dan map hanya key yang kita butuhkan, sekaligus ganti ke uppercase
        $raw = $data['timings'];
        $prayerTimes = [
            'IMSAK'   => substr($raw['Imsak'], 0, 5),
            'SUBUH'   => substr($raw['Fajr'], 0, 5),
            'DZUHUR'  => substr($raw['Dhuhr'], 0, 5),
            'ASHAR'   => substr($raw['Asr'], 0, 5),
            'MAGHRIB' => substr($raw['Maghrib'], 0, 5),
            'ISYA'    => substr($raw['Isha'], 0, 5),
        ];

         //Format tanggal Masehi ke “Rabu, 11 Juni 2025”
        $gregorianDate = Carbon::parse($data['date']['gregorian']['date'])
                            ->locale('id')
                            ->isoFormat('dddd, D MMMM YYYY');

        // 2) Ambil data Hijri dari API, contoh month.en = “Dhū al-Ḥijjah”
        $hijri = $data['date']['hijri'];
        $hijriDate = sprintf(
            '%d %s %d H',
            $hijri['day'],
            $hijri['month']['en'],
            $hijri['year']
        );

        
        return Inertia::render('display/Index', [
            'prayerTimes' => $prayerTimes,
            'gregorianDate' =>  $gregorianDate,
            'hijriDate' => $hijriDate,
            'mosqueName' => $mosqueName,
            'mosqueAddress' =>  $mosqueAddress,
            'runningText' => $runningText,
            'embedVideoId' => $embedVideoId,
            'activeTemplate' => 'modern', // nanti bisa ambil dari database setting
        ]);
    }
}

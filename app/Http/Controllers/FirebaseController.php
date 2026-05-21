<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    protected $database;

    protected $databasePivot;

    protected $databaseTsel;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/tiket-6668b-firebase-adminsdk-fbsvc-a4817d56fe.json'))
            ->withDatabaseUri('https://tiket-6668b-default-rtdb.asia-southeast1.firebasedatabase.app/');
        $this->database = $factory->createDatabase();

        $factoryPivot = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/pivottelkom-firebase-adminsdk-fbsvc-b830c90d0e.json'))
            ->withDatabaseUri('https://pivottelkom-default-rtdb.asia-southeast1.firebasedatabase.app/');
        $this->databasePivot = $factoryPivot->createDatabase();

        $factoryTsel = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/layanantsel-bb6c9-firebase-adminsdk-fbsvc-2e80cc2915.json'))
            ->withDatabaseUri('https://layanantsel-bb6c9-default-rtdb.asia-southeast1.firebasedatabase.app/');
        $this->databaseTsel = $factoryTsel->createDatabase();
    }

    public function aksesNilai()
    {
        $title = 'ALL B2B';
        $data = $this->database->getReference('data_tiket_all');
        $snapshot = $data->getValue();
        \Log::info(request()->headers->all());

        if (request()->ajax()) {
            return view('dashboard.tiket_roling', compact('snapshot'));
        }

        return view('dashboard.tiket', compact('snapshot', 'title'));
    }

    public function getTsel()
    {
        $title = 'SQUAT';
        $data = $this->databaseTsel->getReference('data_tsel_all');
        $snapshot = $data->getValue();
        \Log::info(request()->headers->all());

        if (request()->ajax()) {
            return view('dashboard.tsel_roling', compact('snapshot'));
        }

        return view('dashboard.tsel', compact('snapshot', 'title'));
    }

    public function getPivot()
    {
        $title = 'Pivot B2B';

        try {

            $snapshotPivot = $this->databasePivot
                ->getReference('/')
                ->getValue() ?? [];

            $serviceAreas = [
                'PAREPARE' => ['PRE', 'BAR'],
                'PALOPO' => ['PLP', 'BLP'],
                'PINRANG' => ['PIN', 'SID', 'RPN', 'TTE'],
                'LUWU UTARA' => ['TMN', 'MAS', 'MLL', 'SRK'],
                'TORAJA' => ['RTP', 'MAK', 'ENR'],
                'MAJENE' => ['PLW', 'WON', 'MAJ', 'MMS'],
                'MAMUJU' => ['MAM', 'PKA', 'TPY'],
                'WAJO' => ['SIW', 'AJN', 'WTG', 'SKG', 'CGI'],
            ];

            // ============================
            // HITUNG GRAND TOTAL DI SINI
            // ============================

            $grandTotal = [
                'tsel' => 0,
                'datin' => ['k2' => 0, 'k3' => 0],
                'indibiz' => ['reguler' => 0, 'voice' => 0, 'iptv' => 0],
                'wms' => 0,
                'sqm_b2b' => ['datin' => 0, 'indibiz' => 0, 'wms' => 0],
                'unspec_b2b' => ['indibiz' => 0, 'wms' => 0, 'datin' => 0],
            ];

            $grandTotalAll = 0;

            foreach ($serviceAreas as $area => $stos) {
                foreach ($stos as $sto) {

                    $item = $snapshotPivot[$sto] ?? [];

                    $grandTotal['tsel'] += $item['tsel'] ?? 0;
                    $grandTotal['datin']['k2'] += $item['datin']['k2'] ?? 0;
                    $grandTotal['datin']['k3'] += $item['datin']['k3'] ?? 0;

                    $grandTotal['indibiz']['reguler'] += $item['indibiz']['reguler'] ?? 0;
                    $grandTotal['indibiz']['voice'] += $item['indibiz']['voice'] ?? 0;
                    $grandTotal['indibiz']['iptv'] += $item['indibiz']['iptv'] ?? 0;

                    $grandTotal['wms'] += $item['wms'] ?? 0;

                    $grandTotal['sqm_b2b']['datin'] += $item['sqm_b2b']['datin'] ?? 0;
                    $grandTotal['sqm_b2b']['indibiz'] += $item['sqm_b2b']['indibiz'] ?? 0;
                    $grandTotal['sqm_b2b']['wms'] += $item['sqm_b2b']['wms'] ?? 0;

                    $grandTotal['unspec_b2b']['indibiz'] += $item['unspec_b2b']['indibiz'] ?? 0;
                    $grandTotal['unspec_b2b']['wms'] += $item['unspec_b2b']['wms'] ?? 0;
                    $grandTotal['unspec_b2b']['datin'] += $item['unspec_b2b']['datin'] ?? 0;

                    $grandTotalAll +=
                        ($item['tsel'] ?? 0) +
                        ($item['datin']['k2'] ?? 0) +
                        ($item['datin']['k3'] ?? 0) +
                        ($item['indibiz']['reguler'] ?? 0) +
                        ($item['indibiz']['voice'] ?? 0) +
                        ($item['indibiz']['iptv'] ?? 0) +
                        ($item['wms'] ?? 0) +
                        ($item['sqm_b2b']['datin'] ?? 0) +
                        ($item['sqm_b2b']['indibiz'] ?? 0) +
                        ($item['sqm_b2b']['wms'] ?? 0) +
                        ($item['unspec_b2b']['indibiz'] ?? 0) +
                        ($item['unspec_b2b']['wms'] ?? 0) +
                        ($item['unspec_b2b']['datin'] ?? 0);
                }
            }

            // ============================
            // RETURN VIEW
            // ============================

            if (request()->ajax()) {
                return response()->json([
                    'body' => view('dashboard.pivot_roling',
                        compact('serviceAreas', 'snapshotPivot', 'grandTotal', 'grandTotalAll')
                    )->render(),

                    'footer' => view('dashboard.pivot_footer_roling',
                        compact('serviceAreas', 'snapshotPivot', 'grandTotal', 'grandTotalAll')
                    )->render(),
                ]);
            }

            return view('dashboard.pivot',
                compact('serviceAreas', 'snapshotPivot', 'grandTotal', 'grandTotalAll', 'title')
            );

        } catch (\Exception $e) {
            \Log::error('Error getPivot: '.$e->getMessage());

            return back()->with('error', 'Gagal mengambil data pivot');
        }
    }

    public function index()
    {
        $title = 'Persentase ALL B2B';
        try {
            $data = $this->database->getReference('data_tiket_all')->getValue() ?? [];
            $coll = collect($data);

            $dataDatinK3 = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'DATIN K3';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'DATIN K3')->count(),
            ];
            $dataDatinK2 = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'DATIN K2';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'DATIN K2')->count(),
            ];

            $dataDatin = [
                $dataDatinK3[0] + $dataDatinK2[0],
                $dataDatinK3[1] + $dataDatinK2[1],
            ];

            $dataINDIBIZRGULER = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'INDIBIZ REGULER';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'INDIBIZ REGULER')->count(),
            ];

            $dataIPTV = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'IPTV';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'IPTV')->count(),
            ];

            $dataVOICE = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'VOICE';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'VOICE')->count(),
            ];

            $dataIdibiz = [
                $dataINDIBIZRGULER[0] + $dataIPTV[0] + $dataVOICE[0],
                $dataINDIBIZRGULER[1] + $dataIPTV[1] + $dataVOICE[1],
            ];

            $dataWMS = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'WMS';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'WMS')->count(),
            ];

            $dataSQMINDIBIZ = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'SQM INDIBIZ';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'SQM INDIBIZ')->count(),
            ];

            $dataSQMDATIN = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'SQM DATIN';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'SQM DATIN')->count(),
            ];

            $dataSQMVMS = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'SQM VMS';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'SQM VMS')->count(),
            ];

            $dataSQM = [
                $dataSQMDATIN[0] + $dataSQMINDIBIZ[0] + $dataSQMVMS[0],
                $dataSQMDATIN[1] + $dataSQMINDIBIZ[1] + $dataSQMVMS[1],
            ];

            $dataUNSPECTDATIN = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'UNSPEC DATIN';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'UNSPEC DATIN')->count(),
            ];

            $dataUNSPECINDIBIZ = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'UNSPEC INDIBIZ';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'UNSPEC INDIBIZ')->count(),
            ];
            $dataUNSPECVMS = [
                $coll->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN'] ?? '') === 'UNSPEC VMS';
                })->count(),
                $dataClose = $coll->where('LAYANAN', 'UNSPEC VMS')->count(),
            ];

            $dataUnspec = [
                $dataUNSPECINDIBIZ[0] + $dataUNSPECTDATIN[0] + $dataUNSPECVMS[0],
                $dataUNSPECINDIBIZ[1] + $dataUNSPECTDATIN[1] + $dataUNSPECVMS[1],
            ];

            $tsel = $this->databaseTsel->getReference('data_tsel_all')->getValue() ?? [];
            $collTsel = collect($tsel);
            $dataTSEL = [
                $collTsel->filter(function ($item) {
                    return ($item['STATUS'] ?? '') === 'CLOSED'
                        && ($item['LAYANAN_FO'] ?? '') === 'TELKOM';
                })->count(),
                $dataClose = $collTsel->count(),
            ];

            $hasilPersentase = [
                ['close' => $dataTSEL[0], 'belum' => ($dataTSEL[1] - $dataTSEL[0])],
                ['close' => $dataDatin[0], 'belum' => ($dataDatin[1] - $dataDatin[0])],
                ['close' => $dataIdibiz[0], 'belum' => ($dataIdibiz[1] - $dataIdibiz[0])],
                ['close' => $dataWMS[0], 'belum' => ($dataWMS[1] - $dataWMS[0])],
                ['close' => $dataSQM[0], 'belum' => ($dataSQM[1] - $dataSQM[0])],
                ['close' => $dataUnspec[0], 'belum' => ($dataUnspec[1] - $dataUnspec[0])],
            ];
            $nilai = [
                [$dataTSEL[0], ($dataTSEL[1] - $dataTSEL[0])],
                [$dataDatin[0], ($dataDatin[1] - $dataDatin[0])],
                [$dataIdibiz[0], ($dataIdibiz[1] - $dataIdibiz[0])],
                [$dataWMS[0], ($dataWMS[1] - $dataWMS[0])],
                [$dataSQM[0], ($dataSQM[1] - $dataSQM[0])],
                [$dataUnspec[0], ($dataUnspec[1] - $dataUnspec[0])],
            ];

            if (request()->ajax()) {
                return view('dashboard.index_roling', compact('hasilPersentase', 'nilai', 'title'));
            }
            // if (request()->ajax()) {
            //     return response()->json([
            //         'body' => view('dashboard.pivot_roling', compact(
            //             'serviceAreas', 'snapshotPivot'
            //         ))->render(),

            //         'footer' => view('dashboard.pivot_footer_roling', compact(
            //             'grandTotal', 'grandTotalAll'
            //         ))->render(),
            //     ]);
            // }

            return view('dashboard.index', compact('hasilPersentase', 'nilai', 'title'));

        } catch (\Exception $e) {

            \Log::error('Error getPivot: '.$e->getMessage());

            return back()->with('error', 'Gagal mengambil data pivot');
        }
    }
}

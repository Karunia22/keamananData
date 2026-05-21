{{-- index roling --}}
@php
    $data = $nilai;
@endphp
<div class="item2">
    <div class="card">
        <h4 style="text-align: center">TSEL</h4>
        <ul>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #00c66a; border-radius: 50%;"></div>
                    <span>Close: </span>
                </div>
                <p>
                    {{ $data[0][0] }}
                </p>
            </li>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #da3d11; border-radius: 50%;"></div>
                    <span>Belum Close: </span>
                </div>
                <p>
                    {{ $data[0][1] }}
                </p>
            </li>
        </ul>
    </div>
    <div class="bingkai">
        <canvas id="tiketChart1"></canvas>
    </div>
</div>
<div class="item2">
    <div class="card">
        <div>
            <h4 style="text-align: center">DATIN</h4>
            <h4 style="text-align: center">K2 & K3</h4>
        </div>
        <ul>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #00c66a; border-radius: 50%;"></div>
                    <span>Close: </span>
                </div>
                <p>
                    {{ $data[1][0] }}
                </p>
            </li>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #da3d11; border-radius: 50%;"></div>
                    <span>Belum Close: </span>
                </div>
                <p>
                    {{ $data[1][1] }}
                </p>
            </li>
        </ul>
    </div>
    <div class="bingkai">
        <canvas id="tiketChart2"></canvas>
    </div>

</div>
<div class="item2">
    <div class="card">
        <h4 style="text-align: center">INDIBIZ</h4>
        <h4 style="text-align: center">DATIN|VOICE|IPTV</h4>
        <ul>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #00c66a; border-radius: 50%;"></div>
                    <span>Close: </span>
                </div>
                <p>
                    {{ $data[2][0] }}
                </p>
            </li>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #da3d11; border-radius: 50%;"></div>
                    <span>Belum Close: </span>
                </div>
                <p>
                    {{ $data[2][1] }}
                </p>
            </li>
        </ul>
    </div>
    <div class="bingkai">
        <canvas id="tiketChart3"></canvas>
    </div>
</div>
<div class="item2">
    <div class="card">
        <div>
            <h4 style="text-align: center">WMS</h4>
        </div>
        <ul>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #00c66a; border-radius: 50%;"></div>
                    <span>Close: </span>
                </div>
                <p>
                    {{ $data[3][0] }}
                </p>
            </li>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #da3d11; border-radius: 50%;"></div>
                    <span>Belum Close: </span>
                </div>
                <p>
                    {{ $data[3][1] }}
                </p>
            </li>
        </ul>
    </div>
    <div class="bingkai">
        <canvas id="tiketChart4"></canvas>
    </div>
</div>
<div class="item2">
    <div class="card">
        <div>
            <h4 style="text-align: center">SQM B2B</h4>
            <h4 style="text-align: center">DATIN|INDIBIZ|WMS</h4>
        </div>
        <ul>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #00c66a; border-radius: 50%;"></div>
                    <span>Close: </span>
                </div>
                <p>
                    {{ $data[4][0] }}
                </p>
            </li>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #da3d11; border-radius: 50%;"></div>
                    <span>Belum Close: </span>
                </div>
                <p>
                    {{ $data[4][1] }}
                </p>
            </li>
        </ul>
    </div>
    <div class="bingkai">
        <canvas id="tiketChart5"></canvas>
    </div>
</div>
<div class="item2">
    <div class="card">
        <div>
            <h4 style="text-align: center">UNSPEC B2B</h4>
            <h4 style="text-align: center">DATIN|INDIBIZ|WMS</h4>
        </div>
        <ul>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #00c66a; border-radius: 50%;"></div>
                    <span>Close: </span>
                </div>
                <p>
                    {{ $data[5][0] }}
                </p>
            </li>
            <li>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 21px; height: 21px; background-color: #da3d11; border-radius: 50%;"></div>
                    <span>Belum Close: </span>
                </div>
                <p>
                    {{ $data[5][1] }}
                </p>
            </li>
        </ul>
    </div>
    <div class="bingkai">
        <canvas id="tiketChart6"></canvas>
    </div>
</div>

<script>
    window.dataCharts = @json($hasilPersentase)
</script>

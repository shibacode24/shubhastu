@extends('layout')
@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <h6 class="mb-0 text-uppercase"></h6> 
 <!--<div class="row align-items-center" style="margin-top: -10%;">
            <div class="col-md-2">
                <h6 class="mb-0 text-uppercase" style="font-weight: bold;"></h4>
            </div>
            <div class="col-md-12">
                {{-- <form class=""  action=""
                method="post"> --}}
                    <div class="row row-cols-md-auto g-lg-3">
                        <div class="col-md-3">
                            <label for="inputFromDate" class=" col-form-label text-md-end">From Date</label>

                            <input type="date" class="form-control" id="inputFromDate">
                        </div>
                        <div class="col-md-3">
                            <label for="inputToDate" class=" col-form-label text-md-end">To Date</label>

                            <input type="date" class="form-control" id="inputToDate">
                        </div>

                        <div class="col-md-4" style="padding:8px; margin-top:2%;"><br>
                            <button type="submit" class="btn btn-primary px-3"><i class="lni lni-search-alt"></i> Search</a></button>	
                            </div>

                    </div>
                </form>
            </div>
        </div> -->
         <!-- <div style="margin-left: 200px;">
            <img src="assets/images/legend.png" style="max-width: 450px;">
        </div> -->
         
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4" >
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary" style="color: rgb(62, 59, 59) !important;">
                                    Company</p>
                                    @php
									$count = DB::table('addcompanies')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">4805</h4> --}}
                                <!-- <p class="mb-0 font-13 text-success"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p> -->
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i
                                    class="bx bx-list-ol"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Stokist</p>
                                @php
									$count = DB::table('stockists')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">8455</h4> --}}
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>$24 from last week</p> -->
                            </div>
                            <div class="widgets-icons bg-light-info text-info ms-auto"><i
                                    class='bx bx-menu'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Medical</p>
                                @php
									$count = DB::table('medicals')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">3456</h4> --}}
                                <!-- <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>$34 from last week</p> -->
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i
                                    class='bx bx-note'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Marketing</p>
                                @php
									$count = DB::table('marketings')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">34.46%</h4> --}}

                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                    class='bx bx-line-chart-down'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Doctor</p>
                                @php
									$count = DB::table('doctors')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">422</h4> --}}
                            </div>
                            <div class="text-primary ms-auto font-35"><i class='bx bxl-chrome'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary"> City</p>
                                @php
									$count = DB::table('cities')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">56M</h4> --}}
                            </div>
                            <div class="text-danger ms-auto font-35"><i class='bx bx-repost'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">No of Medicine </p>
                                @php
									$count = DB::table('medicines')->count();
									echo '<h3>' . $count . '</h3>';
									@endphp
                                {{-- <h4 class="my-1" style="color: black;">4245</h4> --}}
                            </div>
                            <div class="text-warning ms-auto font-35"><i class='bx bx-poll'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- <div class="col-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body" style="position: relative;">
                
                    <div class="row m-0 row-cols-1 row-cols-md-4">
                        <div class="col border-end" style="position: relative;">
                            <div id="chart16" style="min-height: 174.55px;">
                                <div id="apexcharts2qbpuhl5" class="apexcharts-canvas apexcharts2qbpuhl5 apexcharts-theme-light" style="width: 204px; height: 174.55px;">
                                    <svg id="SvgjsSvg7119" width="204" height="174.55" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG7121" class="apexcharts-inner apexcharts-graphical" transform="translate(25, 0)"><defs id="SvgjsDefs7120"><clipPath id="gridRectMask2qbpuhl5"><rect id="SvgjsRect7123" width="1565004" height="1785" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask2qbpuhl5"><rect id="SvgjsRect7124" width="160" height="182" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient7130" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7131" stop-opacity="1" stop-color="rgba(242,242,242,1)" offset="0"></stop><stop id="SvgjsStop7132" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop><stop id="SvgjsStop7133" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient7141" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7142" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="0"></stop><stop id="SvgjsStop7143" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop><stop id="SvgjsStop7144" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop></linearGradient></defs><g id="SvgjsG7126" class="apexcharts-radialbar"><g id="SvgjsG7127"><g id="SvgjsG7128" class="apexcharts-tracks"><g id="SvgjsG7129" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 77.98865755222343 24.012561965425036" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.30438292682927" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 77.98865755222343 24.012561965425036"></path></g></g><g id="SvgjsG7135"><g id="SvgjsG7140" class="apexcharts-series apexcharts-radial-series" seriesName="NIH" rel="1" data:realIndex="0"><path id="SvgjsPath7145" d="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 19.10137795262564 116.46487851546752" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient7141)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.561219512195123" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="245" data:value="68" index="0" j="0" data:pathOrig="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 19.10137795262564 116.46487851546752"></path></g><circle id="SvgjsCircle7136" r="60.83524756097562" cx="78" cy="89" class="apexcharts-radialbar-hollow" fill="#ceffca"></circle><g id="SvgjsG7137" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText7138" font-family="Helvetica, Arial, sans-serif" x="78" y="81" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#6c757d" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText7139" font-family="Helvetica, Arial, sans-serif" x="78" y="115" text-anchor="middle" dominant-baseline="auto" font-size="25px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">68%</text></g></g></g></g><line id="SvgjsLine7146" x1="0" y1="0" x2="156" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine7147" x1="0" y1="0" x2="156" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG7122" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 229px; height: 182px;"></div></div><div class="contract-trigger"></div></div></div>
                        <div class="col border-end" style="position: relative;">
                            <div id="chart17" style="min-height: 180.7px;"><div id="apexcharts52t932ob" class="apexcharts-canvas apexcharts52t932ob apexcharts-theme-light" style="width: 204px; height: 180.7px;"><svg id="SvgjsSvg7148" width="204" height="180.70000000000002" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG7150" class="apexcharts-inner apexcharts-graphical" transform="translate(25, 0)"><defs id="SvgjsDefs7149"><clipPath id="gridRectMask52t932ob"><rect id="SvgjsRect7152" width="162" height="180" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask52t932ob"><rect id="SvgjsRect7153" width="160" height="182" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient7159" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7160" stop-opacity="1" stop-color="rgba(242,242,242,1)" offset="0"></stop><stop id="SvgjsStop7161" stop-opacity="1" stop-color="rgba(244,17,39,1)" offset="1"></stop><stop id="SvgjsStop7162" stop-opacity="1" stop-color="rgba(244,17,39,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient7170" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7171" stop-opacity="1" stop-color="rgba(244,17,39,1)" offset="0"></stop><stop id="SvgjsStop7172" stop-opacity="1" stop-color="rgba(244,17,39,1)" offset="1"></stop><stop id="SvgjsStop7173" stop-opacity="1" stop-color="rgba(244,17,39,1)" offset="1"></stop></linearGradient></defs><g id="SvgjsG7155" class="apexcharts-radialbar"><g id="SvgjsG7156"><g id="SvgjsG7157" class="apexcharts-tracks"><g id="SvgjsG7158" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 1 1 77.98822034724802 21.50756200357837" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.62448292682927" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 1 1 77.98822034724802 21.50756200357837"></path></g></g><g id="SvgjsG7164"><g id="SvgjsG7169" class="apexcharts-series apexcharts-radial-series" seriesName="% Repeat Patient" rel="1" data:realIndex="0"><path id="SvgjsPath7174" d="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 1 1 38.32893970021443 143.6025301625466" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient7170)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.891219512195123" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="216" data:value="60" index="0" j="0" data:pathOrig="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 1 1 38.32893970021443 143.6025301625466"></path></g><circle id="SvgjsCircle7165" r="63.180197560975614" cx="78" cy="89" class="apexcharts-radialbar-hollow" fill="#ffd6da"></circle><g id="SvgjsG7166" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText7167" font-family="Helvetica, Arial, sans-serif" x="78" y="81" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#6c757d" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText7168" font-family="Helvetica, Arial, sans-serif" x="78" y="115" text-anchor="middle" dominant-baseline="auto" font-size="25px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">60%</text></g></g></g></g><line id="SvgjsLine7175" x1="0" y1="0" x2="156" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine7176" x1="0" y1="0" x2="156" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG7151" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 229px; height: 182px;"></div></div><div class="contract-trigger"></div></div></div>
                        <div class="col col border-end" style="position: relative;">
                            <div id="chart18" style="min-height: 180.7px;"><div id="apexcharts6tdpi29g" class="apexcharts-canvas apexcharts6tdpi29g apexcharts-theme-light" style="width: 205px; height: 180.7px;"><svg id="SvgjsSvg7177" width="205" height="180.70000000000002" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG7179" class="apexcharts-inner apexcharts-graphical" transform="translate(25.5, 0)"><defs id="SvgjsDefs7178"><clipPath id="gridRectMask6tdpi29g"><rect id="SvgjsRect7181" width="162" height="180" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask6tdpi29g"><rect id="SvgjsRect7182" width="160" height="182" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient7188" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7189" stop-opacity="1" stop-color="rgba(242,242,242,1)" offset="0"></stop><stop id="SvgjsStop7190" stop-opacity="1" stop-color="rgba(255,193,7,1)" offset="1"></stop><stop id="SvgjsStop7191" stop-opacity="1" stop-color="rgba(255,193,7,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient7199" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7200" stop-opacity="1" stop-color="rgba(255,193,7,1)" offset="0"></stop><stop id="SvgjsStop7201" stop-opacity="1" stop-color="rgba(255,193,7,1)" offset="1"></stop><stop id="SvgjsStop7202" stop-opacity="1" stop-color="rgba(255,193,7,1)" offset="1"></stop></linearGradient></defs><g id="SvgjsG7184" class="apexcharts-radialbar"><g id="SvgjsG7185"><g id="SvgjsG7186" class="apexcharts-tracks"><g id="SvgjsG7187" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 1 1 77.98822034724802 21.50756200357837" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.62448292682927" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 1 1 77.98822034724802 21.50756200357837"></path></g></g><g id="SvgjsG7193"><g id="SvgjsG7198" class="apexcharts-series apexcharts-radial-series" seriesName="InxProgress" rel="1" data:realIndex="0"><path id="SvgjsPath7203" d="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 0 1 98.85631065035149 153.18912393479968" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient7199)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.891219512195123" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="162" data:value="45" index="0" j="0" data:pathOrig="M 78 21.50756097560975 A 67.49243902439025 67.49243902439025 0 0 1 98.85631065035149 153.18912393479968"></path></g><circle id="SvgjsCircle7194" r="63.180197560975614" cx="78" cy="89" class="apexcharts-radialbar-hollow" fill="#ffedb9"></circle><g id="SvgjsG7195" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText7196" font-family="Helvetica, Arial, sans-serif" x="78" y="81" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#6c757d" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText7197" font-family="Helvetica, Arial, sans-serif" x="78" y="115" text-anchor="middle" dominant-baseline="auto" font-size="25px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">45%</text></g></g></g></g><line id="SvgjsLine7204" x1="0" y1="0" x2="156" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine7205" x1="0" y1="0" x2="156" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG7180" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 230px; height: 182px;"></div></div><div class="contract-trigger"></div></div></div>
                    
                        <div class="col" style="position: relative;">
                            <div id="chart19" style="min-height: 174.55px;"><div id="apexcharts2qbpuhl5" class="apexcharts-canvas apexcharts2qbpuhl5 apexcharts-theme-light" style="width: 204px; height: 174.55px;"><svg id="SvgjsSvg7119" width="204" height="174.55" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG7121" class="apexcharts-inner apexcharts-graphical" transform="translate(28, 0)"><defs id="SvgjsDefs7120"><clipPath id="gridRectMask2qbpuhl5"><rect id="SvgjsRect7123" width="1565004" height="1785" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask2qbpuhl5"><rect id="SvgjsRect7124" width="160" height="182" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient7130" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7131" stop-opacity="1" stop-color="rgba(242,242,242,1)" offset="0"></stop><stop id="SvgjsStop7132" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop><stop id="SvgjsStop7133" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient7141" x1="0" y1="1" x2="1" y2="1"><stop id="SvgjsStop7142" stop-opacity="1" stop-color="rgba(25,180,14,1)" offset="0"></stop><stop id="SvgjsStop7143" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop><stop id="SvgjsStop7144" stop-opacity="1" stop-color="rgba(23,160,14,1)" offset="1"></stop></linearGradient></defs><g id="SvgjsG7126" class="apexcharts-radialbar"><g id="SvgjsG7127"><g id="SvgjsG7128" class="apexcharts-tracks"><g id="SvgjsG7129" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 77.98865755222343 24.012561965425036" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.30438292682927" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 77.98865755222343 24.012561965425036"></path></g></g><g id="SvgjsG7135"><g id="SvgjsG7140" class="apexcharts-series apexcharts-radial-series" seriesName="Completed" rel="1" data:realIndex="0"><path id="SvgjsPath7145" d="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 19.10137795262564 116.46487851546752" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient7141)" stroke-opacity="1" stroke-linecap="round" stroke-width="8.561219512195123" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="245" data:value="68" index="0" j="0" data:pathOrig="M 78 24.012560975609745 A 64.98743902439026 64.98743902439026 0 1 1 19.10137795262564 116.46487851546752"></path></g><circle id="SvgjsCircle7136" r="60.83524756097562" cx="78" cy="89" class="apexcharts-radialbar-hollow" fill=" #99e6ff"></circle><g id="SvgjsG7137" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText7138" font-family="Helvetica, Arial, sans-serif" x="78" y="81" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#6c757d" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText7139" font-family="Helvetica, Arial, sans-serif" x="78" y="115" text-anchor="middle" dominant-baseline="auto" font-size="25px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">58%</text></g></g></g></g><line id="SvgjsLine7146" x1="0" y1="0" x2="156" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine7147" x1="0" y1="0" x2="156" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG7122" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 229px; height: 182px;"></div></div><div class="contract-trigger"></div></div></div>
                    
                    </div>
                    
                <div class="resize-triggers"><div class="expand-trigger"><div style="width: 720px; height: 567px;"></div></div><div class="contract-trigger"></div></div></div>
            </div>
        </div> --}}
        
{{--     
    <div class="card">
        <div class="card-body">
            <div id="chart5"></div>
        </div>
    </div> --}}
    
    <div class="col-12 col-xl-12 d-flex" >
        {{-- <div class="col d-flex col-md-6">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <div class="mt-1" id="chart13"></div>
                </div>
            </div>
            
        </div> --}}
        <!-- <div class="card ">
            <div class="card-body">
                <div id="chart8"></div>
            </div>
        </div> -->
        {{-- <div class="col d-flex col-md-6" style="padding: 3PX;">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <div class="mt-1" id="chart8"></div>
                </div>
            </div> --}}
            
        </div>
    </div>
    </div>


</div>
<!--end page wrapper -->
<!--start overlay-->

</div>
<!-- <div class="row row-cols-lg-12"> -->
<!-- <footer class="page-footer">
<div style="margin-left: 200px;">
    <img src="assets/images/legend.png" style="max-width: 450px;">
</div>
</footer> -->
<!-- </div> -->
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
<!-- <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
</div> -->
<div class="switcher-body">
    <div class="d-flex align-items-center">
        <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
        <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
    </div>
    <hr />
    <h6 class="mb-0">Theme Styles</h6>
    <hr />
    <div class="d-flex align-items-center justify-content-between">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
            <label class="form-check-label" for="lightmode">Light</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
            <label class="form-check-label" for="darkmode">Dark</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
            <label class="form-check-label" for="semidark">Semi Dark</label>
        </div>
    </div>
    <hr />
    <div class="form-check">
        <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
        <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
    </div>
    <hr />
    <h6 class="mb-0">Header Colors</h6>
    <hr />
    <div class="header-colors-indigators">
        <div class="row row-cols-auto g-3">
            <div class="col">
                <div class="indigator headercolor1" id="headercolor1"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor2" id="headercolor2"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor3" id="headercolor3"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor4" id="headercolor4"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor5" id="headercolor5"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor6" id="headercolor6"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor7" id="headercolor7"></div>
            </div>
            <div class="col">
                <div class="indigator headercolor8" id="headercolor8"></div>
            </div>
        </div>
    </div>
    <hr />
    <h6 class="mb-0">Sidebar Backgrounds</h6>
    <hr />
    <div class="header-colors-indigators">
        <div class="row row-cols-auto g-3">
            <div class="col">
                <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
            </div>
            <div class="col">
                <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
            </div>
        </div>
    </div>
</div>
</div>


@stop
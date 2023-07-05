@extends('layouts.layout')
@section('content')
    <div class="container">
        <h6 class="text-end mb-2 text-black-50">الرئيسية</h6>
        <h4 class="text-end mb-5">الاسئلة الشائعة</h4>
    </div>

    <div class="container mb-5 bg-white">
        <div class="header row">
            <table class="table">
              <thead>
                  <tr>
                      <th style="width: 10px">#</th>
                      <th>السؤال</th>
                      <th>الجواب</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($faqs as $faq)
                      <tr>
                          <td>{{ $faq->id }}</td>
                          <td>{{ $faq->title }}</td>
                          <td>{{ $faq->answer }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
           
        </div>
    </div>
@endsection

@extends('layouts.base-layout')
@section('content')
  <div class="container-wrapper about">
    <div class="subcontainer about-jyoutaiji">
      <div class="jumbotron">
        <span class="description">日蓮正宗 佛説山</span><br />
        <span class="english-title">Nichiren-Shoushu Bussetsuzan Joutaiji</span><br />
        <span class="title">誠諦寺</span>

        <article>
          <h3>誠諦寺(じょうたいじ)は、</h3>
          
          栃木県宇都宮市にある日蓮正宗の末寺寺院です。<br />
          山号は佛説山(ぶっせつざん)。<br /><br />
          <ul style="text-align: left;">
            <li>1966年(昭和41年)2月6日- 日蓮正宗大石寺第66世 日達上人の開基により建立。(旧住所)宇都宮市弥生3丁目。</li>
            <li>2001年(平成13年)5月23日- 第67世 日顕上人御親修により、現在の宇都宮市鶴田町の地へ移転し、新築落慶入仏法要が行なわれる。</li>
            <li>交通アクセス　JR日光線 鶴田駅(宇都宮駅から5分 1つ目の駅)下車、西へ徒歩3分。</li>
          </ul>
        </article>
        <br />
        <article>
          <h3>日蓮正宗について</h3>
          日蓮正宗(にちれんしょうしゅう)は、建長5(1253)年4月28日に、日蓮大聖人(にちれんだいしょうにん)が“南無妙法蓮華経”の宗旨を建立されたことに始まります。<br />
          日蓮大聖人は、多くの法難に遭いながらも、法華経(ほけきょう)の肝心である 南無妙法蓮華経 を弘め、弘安2(1279)年10月12日、信仰の根本である本門戒壇(ほんもんかいだん)の大御本尊(だいごほんぞん)を建立されました。<br />
          その後、日興上人(にっこうしょうにん)を第2祖と定めて仏法の一切を付嘱し、同5年10月13日、61歳をもって入滅されました。<br />
          日蓮大聖人の入滅後、身延の地頭・波木井実長(はきりさねなが)が、仏法に違背する行為を重ねたため、日興上人は正応2(1289)年の春、本門戒壇の大御本尊をはじめ一切の重宝をお持ちして、門弟とともに身延を離れ、翌正応3年10月、南条時光殿の寄進により、富士上野の地に大石寺(たいせきじ)を建立しました。<br />
          以来700有余年、日蓮大聖人の仏法は、日蓮正宗 総本山大石寺に正しく伝えられています。<br /><br />
          日蓮正宗 総本山 大石寺公式ホームページ<br />
          <a href="http://www.nichirenshoshu.or.jp/">ここからクリックしてください。</a>
        </article>
      </div>
    </div>
  </div>
@endsection

@section('stylesheet')
  <link href="{{mix('css/pages/about.css')}}" rel="stylesheet">
  <link href="{{mix('css/components/scroll-history.css')}}" rel="stylesheet">
  <style>
    .about-jyoutaiji {
      text-align: center;
    }
    .description {
      font-size: 4rem;
    }
    .title {
      font-size: 12rem;
    }
  </style>
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('pages.about'),
  'title' => trans('common.about-jyoutaiji')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.about-jyoutaiji')])
@endsection
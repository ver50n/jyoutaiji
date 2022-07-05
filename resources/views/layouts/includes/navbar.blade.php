<nav class="navbar navbar-expand-md navbar-light fixed-top">
	<div class="container">
		<div class="navbar-brand-wrapper">
			<a class="navbar-brand" href="{{ route('pages.root') }}" style="color: white;">
			|	@lang('common.brand') |
			</a>
		</div>
		<button class="navbar-toggler"
			type="button"
			data-toggle="collapse"
			data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent"
			aria-expanded="false" aria-label="Toggle navigation">
			<i class="c_icon fas fa-list"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('pages.home') }}">
						@lang('common.home')
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('pages.schedule') }}">
						@lang('common.schedule')
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('pages.about') }}">
						@lang('common.about-jyoutaiji')
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('pages.contact') }}">
						@lang('common.contact')
					</a>
				</li>
				<!-- <li class="nav-item" style="margin-left: 10px;">
					<a class="language-selection-nav-link" href="#"
					data-toggle="modal"
					data-target="#language-selection-modal">
					@php
					$languages = \App\Helpers\ApplicationConstant::LANGUAGE;
					$selected = Session::get('locale');
					@endphp
						@lang('application-constant.LANGUAGE.'.$selected)
					</a>
				</li> -->
			</ul>
		</div>
	</div>
</nav>

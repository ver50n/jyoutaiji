<div class="c_schedule-participant">
  <div class="profile-image">
    @include('components.user-profile-image', [
      'image' => $participant->user ? \App\Utils\FileUtil::getImageUrl('profile_icon', $participant->user->profile_icon) : null,
      'size' => $size
    ])
  </div>
  <div class="participant-data">
    {{ ($participant->user) ? $participant->user->name : $participant->name }}<br />
    <span class="participant-note">{{ $participant->note }}</span>
  </div>
</div>
<?php
  return [
    'url' => [
      'original'  => "https://s3.".env('AWS_REGION').".amazonaws.com/". env('AWS_BUCKET') ."/place_images/originals/",
      'thumb'  => "https://s3.".env('AWS_REGION').".amazonaws.com/". env('AWS_BUCKET') ."/place_images/thumbs/",
      'mobileapi'  => "https://s3.".env('AWS_REGION').".amazonaws.com/". env('AWS_BUCKET') ."/place_images/apis/",
      'noimage'  => "https://s3.".env('AWS_REGION').".amazonaws.com/". env('AWS_BUCKET') ."/utils/noimage.jpg",
    ],

    'folder' => [
      'original' => "place_images/originals/",
      'thumb' => "place_images/thumbs/",
      'mobileapi' => "place_images/apis/",
    ],

    'size' => [
      'original' => ['width' => 1600, 'height' => 900 ],
      'thumb' => ['width' => 320, 'height' => 180 ],
      'mobileapi' => ['width' => 800, 'height' => 450],
    ],

  ]
 ?>

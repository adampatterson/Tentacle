<?php
    require_once "AutoEmbed.class.php";

    class Video {
        public function __init() {
            $this->setField(array("attr" => "video",
                                  "type" => "text_block",
                                  "rows" => 4,
                                  "label" => __("Video", "video"),
                                  "preview" => true,
                                  "bookmarklet" => $this->isVideo() ? "url" : "")) ;
            $this->setField(array("attr" => "caption",
                                  "type" => "text_block",
                                  "rows" => 4,
                                  "label" => __("Caption", "video"),
                                  "optional" => true,
                                  "preview" => true,
                                  "bookmarklet" => "selection"));

            if ($this->isVideo())
                $this->bookmarkletSelected();

            $this->setFilter("caption", array("markup_text", "markup_post_text"));

            $this->respondTo("preview_video", "embed_tag");
        }

        public function submit() {
            if (empty($_POST['video']))
                error(__("Error"), __("Video can't be blank."));

            return Post::add(array("embed" => $this->embed_tag($_POST['video']),
                                   "video" => $_POST['video'],
                                   "caption" => $_POST['caption']),
                             $_POST['slug'],
                             Post::check_url($_POST['slug']));
        }

        public function update($post) {
            if (empty($_POST['video']))
                error(__("Error"), __("Video can't be blank."));

            $post->update(array("embed" => $this->embed_tag($_POST['video']),
                                "video" => $_POST['video'],
                                "caption" => $_POST['caption']));
        }

        public function title($post) {
            return $post->title_from_excerpt();
        }

        public function excerpt($post) {
            return $post->caption;
        }

        public function feed_content($post) {
            return $post->embed."<br /><br />".$post->caption;
        }

        public function embed_tag($video, $field = null) { # We use this for previewing too
            if (isset($field) and $field != "embed")
                return $video; # If they're previewing and the field argument isn't the embed, return the original.

            $AE = new AutoEmbed();
            if ($AE->parseUrl($video)) {
                $AE->setParam("wmode", "transparent");
                return $AE->getEmbedCode();
            } else
                return $video;
        }

        public function embed_tag_for($post, $max_width = 500) {
            $post->embed = preg_replace("/&([[:alnum:]_]+)=/", "&amp;\\1=", $post->embed);

            if (preg_match("/width(=\"|='|:\s*)([0-9]+)/", $post->embed, $width)) {
                $sep_w = $width[1];
                $original_width = $width[2];
            } else
                return $post->embed;

            if (preg_match("/height(=\"|='|:\s*)([0-9]+)/", $post->embed, $height)) {
                $sep_h  = $height[1];
                $original_height = $height[2];

                $new_height = (int) (($max_width / $original_width) * $original_height);
            }

            $post->embed = str_replace(array($width[0], $height[0]), array("width".$sep_w.$max_width, "height".$sep_h.$new_height), $post->embed);

            return $post->embed;
        }

        public function isVideo() {
            if (!isset($_GET['url']))
                return false;

            $AE = new AutoEmbed();
            return $result = $AE->parseUrl($_GET['url']) ? true : false ;
        }
    }

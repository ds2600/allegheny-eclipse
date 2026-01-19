<!DOCTYPE html>
<html lang="en">
<head>
<?php
$page_title = 'Allegheny Eclipse - 2025 Archive';
$page_desc  = 'Allegheny Eclipse 2025 season archive: performances, events, and photos.';
include '../inc/head.php';
?>
</head>
<body>
<?php include '../inc/navbar.php'; ?>

<section class="subpage-content archive-year">
    <div class="container">
        <h1>2025</h1>
        <div class="content" style="text-align:center;">
        <section id="team">
                <div class="team-container">
                    <div class="team-text">
                        <h2>Meet the Team</h2>
                        <p>Our team is a vibrant group of passionate performers who bring energy, creativity, and heart to Allegheny Eclipse. Get to know the faces behind the flags!</p>
                    </div>
                    <div class="team-profiles">
                     <?php
                        $team_data = @file_get_contents('data/team_2025.json');
                        if ($team_data === false || ($members = json_decode($team_data, true)) === null || !isset($members['members'])) {
                            echo '<p class="error-message">Unable to load team data. Please try again later.</p>';
                        } else {
                            $members = $members['members'];
                            $titled_members = array_filter($members, function($member) {
                                return !empty($member['title']);
                            });
                            $untitled_members = array_filter($members, function($member) {
                                return empty($member['title']);
                            });
                            $title_order = ['Director', 'Co-Director', 'Co-Directors', 'Instructor'];
                            usort($titled_members, function($a, $b) use ($title_order) {
                                $order_a = array_search($a['title'], $title_order);
                                $order_b = array_search($b['title'], $title_order);
                                if ($order_a === false) $order_a = PHP_INT_MAX;
                                if ($order_b === false) $order_b = PHP_INT_MAX;
                                return $order_a <=> $order_b;
                            });
                            usort($untitled_members, function($a, $b) {
                                $first_a = explode(' ', trim($a['name']))[1];
                                $first_b = explode(' ', trim($b['name']))[1];
                                return strcmp($first_a, $first_b);
                            });
                            $sorted_members = array_merge($titled_members, $untitled_members);

                            usort($sorted_members, function($a, $b) use ($title_order) {
                                $prio_a = isset($a['priority']) ? intval($a['priority']) : 0;
                                $prio_b = isset($b['priority']) ? intval($b['priority']) : 0;

                                if ($prio_a !== $prio_b) {
                                    return $prio_a <=> $prio_b;
                                }

                                // Same priority or both 0, fall back to normal sorting
                                $has_title_a = !empty($a['title']);
                                $has_title_b = !empty($b['title']);

                                if ($has_title_a && $has_title_b) {
                                    $order_a = array_search($a['title'], $title_order);
                                    $order_b = array_search($b['title'], $title_order);
                                    if ($order_a === false) $order_a = PHP_INT_MAX;
                                    if ($order_b === false) $order_b = PHP_INT_MAX;
                                    return $order_a <=> $order_b;
                                }

                                if ($has_title_a) return -1;
                                if ($has_title_b) return 1;

                                // Both untitled, sort by last name
                                $last_a = explode(' ', trim($a['name']))[1] ?? '';
                                $last_b = explode(' ', trim($b['name']))[1] ?? '';
                                return strcmp($last_a, $last_b);
                            });
                            foreach ($sorted_members as $member) {
                                $name_content = htmlspecialchars($member['name']);
                                $offset_style = '';
                                if (isset($member['offset_x']) && isset($member['offset_y'])) {
                                    $offset_style = ' style="object-position: ' . htmlspecialchars($member['offset_x'] ?? '50%') . ' ' . htmlspecialchars($member['offset_y'] ?? '50%') . '; "';
                                }
                                $img_src = !empty($member['image']) 
                                            && file_exists($_SERVER['DOCUMENT_ROOT'] . '/'
                                                          . ltrim($member['image'], '/'))
                                            ? $member['image']
                                            : 'img/team/placeholder.png';
                                    
                                $image_tag = '<img src="' . htmlspecialchars($img_src) . '" alt="' . htmlspecialchars($member['name']) . '" class="profile-img"' . $offset_style . '>';
                                if (!empty($member['bio_url'])) {
                                    $name_content = '<a href="' . htmlspecialchars($member['bio_url']) . '" class="profile-link">' . htmlspecialchars($member['name']) . '</a>';
                                    $image_tag = '<a href="' . htmlspecialchars($member['bio_url']) . '" class="profile-link">' . $image_tag . '</a>';
                                }
                                echo '
                                <div class="profile">
                                    ' . $image_tag . '
                                    <h3>' . $name_content . '</h3>
                                    ' . (!empty($member['title']) ? '<p class="profile-title">' . htmlspecialchars($member['title']) . '</p>' : '') . '
                                </div>';
                            }
                        }
                        ?>            
                    </div>
                </div>
            </section>

        </div>
    </div>
</section>

<!-- Section 1 (purple gradient) 
<section class="archive-section archive-section--purple">
    <div class="container">
        <div class="archive-section-title">
            <h2>Season Highlights</h2>
            <p>Big moments, milestones, and anything you want to call out for the year.</p>
        </div>

        <div class="archive-section-body">
            <p>
                Add a short recap here: show themes, competitions, parades, community events, new members, etc.
            </p>

            <p style="margin-top: 1rem;">
                <a class="btn" href="/signup/">Join Us for 2026</a>
            </p>
        </div>
    </div>
</section>-->

<!-- Section 2 -->
<section class="archive-section archive-section--dark">
    <div class="container">
        <div class="archive-section-title">
            <h2>Performances & Events</h2>
            <p>Coming soon...</p>
        </div>
<?php if (false):  ?> 

        <div class="archive-section-body">
            <ul style="margin-left: 1.2rem;">
                <li><strong>May 2025:</strong> Example event name — Warren, PA</li>
                <li><strong>June 2025:</strong> Example parade/performance — Location</li>
                <li><strong>July 2025:</strong> Example show — Location</li>
                <li><strong>August 2025:</strong> Example event — Location</li>
            </ul>
        </div>
<?php endif; ?>
    </div>
</section>

<!-- Section 3 (purple gradient) -->
<section class="archive-section archive-section--purple">
    <div class="container">
        <div class="archive-section-title">
            <h2>Album</h2>
            <p>Coming soon...</p>
        </div>
<?php if (false):  ?> 

        <!-- Optional actions row (links/buttons) -->
        <div class="archive-album-actions">
            <!-- Replace with real links if you have them -->
            <!-- <a class="btn" href="https://your-cloudinary-album-link" target="_blank" rel="noopener">Full Album</a> -->
            <!-- <a class="btn" href="/contact/">Submit Photos</a> -->
        </div>

        <div class="archive-album">
            <div class="album-grid">
                <!-- Standard tile -->
                <a class="album-item" href="/images/archive/2025/sample-1.jpg">
                    <img class="album-thumb" src="/images/archive/2025/sample-1.jpg" alt="2025 photo 1">
                    <div class="album-caption">Rehearsal Night</div>
                </a>

                <!-- Wide tile example -->
                <a class="album-item album-item--wide" href="/images/archive/2025/sample-2.jpg">
                    <span class="album-badge">Performance</span>
                    <img class="album-thumb" src="/images/archive/2025/sample-2.jpg" alt="2025 photo 2">
                    <div class="album-caption">Show Day</div>
                </a>

                <!-- Tall tile example -->
                <a class="album-item album-item--tall" href="/images/archive/2025/sample-3.jpg">
                    <img class="album-thumb" src="/images/archive/2025/sample-3.jpg" alt="2025 photo 3">
                    <div class="album-caption">Parade Route</div>
                </a>

                <!-- Standard tile -->
                <a class="album-item" href="/images/archive/2025/sample-4.jpg">
                    <img class="album-thumb" src="/images/archive/2025/sample-4.jpg" alt="2025 photo 4">
                    <div class="album-caption">Behind the Scenes</div>
                </a>


            </div>
            <div class="archive-section-title">
                <h2>Thank You</h2>
            </div>

            <div class="archive-section-body" style="text-align: center;">
                <p>
                    Thanks to everyone who supported the 2025 season, from rehearsal nights to performance days.
                </p>
            </div>
        </div>
<?php endif; ?>
    </div>
</section>
<!--
<section class="archive-section archive-section--dark">
    <div class="container">
        <div class="archive-section-title">
            <h2>Thank You</h2>
            <p>Shout-outs to members, volunteers, sponsors, and the community.</p>
        </div>

        <div class="archive-section-body">
            <p>
                Thanks to everyone who supported the 2025 season — from rehearsal nights to performance days.
            </p>
        </div>
    </div>
</section>-->

<?php include '../inc/footer.php'; ?>
<script src="js/scripts.js"></script>
</body>
</html>


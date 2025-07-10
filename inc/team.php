    <section id="team" class="team">
        <div class="team-container">
            <div class="team-text">
                <h2>Meet the Team</h2>
                <p>Our team is a vibrant group of passionate performers who bring energy, creativity, and heart to Allegheny Eclipse. Get to know the faces behind the flags!</p>
            </div>
            <div class="team-profiles">
             <?php
                $team_data = @file_get_contents('data/team.json');
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


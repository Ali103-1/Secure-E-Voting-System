<?php
  ob_start();
  session_start();

    // هنا نتححق من ان الادمين قام بتسجيل دخوله
  if (isset($_SESSION['admin']))
  {




        // افضل طريقة لتقسيم الصفحات الموقع دون الاكثار من ملفات الموقع هي باستعمال الخاصية الشرط التي في الاسفل



          // هنا نضع نقسم صفحة واحد الى عدة صفحات من خلال وضع شرط اسم الصفحة

    $page = isset($_GET['page']) ? $_GET['page'] : 'manage';

    if ($page == 'manage')
    {
      $pageTitle = 'users managements';
      include 'init.php';
      $ord = 'ASC';

      if (isset($_GET['ordering']))
      {
        $ord = $_GET['ordering'];
      }

      $users = AllItems($conn, 'users', $ord);


      ?>
      <div class="default-management-list users-management">
        <div class="container cnt-spc">
          <div class="row">



            <div class="col-md-6">
              <div class="left-header management-header">
                <h1>users managements list</h1>
              </div>
            </div>
            <div class="col-md-6">
              <div class="right-header management-header">
                <?php
                    if($_SESSION['type'] == 2)
                    {
                        ?>
                        <div class="btns">
                          <a href="users.php?page=add" id="open-add-page" class="add-btn"><i class="fas fa-plus"></i></a>

                        </div>
                        <?php
                    }
                 ?>
              </div>
            </div>


            <div class="col-md-12">
              <div class="management-body">
                <div class="default-management-table">
                  <table class="table" id="users-table" style="margin-top:60px">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">image</th>

                        <th scope="col">username</th>
                        <th scope="col">age</th>
                        <th scope="col">phone</th>

                        <th scope="col">adress</th>


                        <th scope="col">type</th>



                        <th scope="col">action</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      foreach($users as $user)
                      {
                        ?>
                        <tr>
                          <td>
                            <p><?php echo $user['id'] ?></p>
                          </td>
                          <td>
                            <div class="avatar">
                              <?php
                                  if (empty($user['image']))
                                  {
                                    ?>
                                    <img src="<?php echo $avatar  ?>default.png" alt="avart" style="width:40px">

                                    <?php
                                  }
                                  if (!empty($user['image']))
                                  {
                                    ?>
                                    <img src="<?php echo $avatar . $user['image']  ?>" alt="avart" style="width:40px">

                                    <?php
                                  }
                               ?>
                            </div>
                          </td>

                          <td>
                            <p class="u-s"><?php
                              echo $user['username']
                             ?></p>
                          </td>
                          <td>
                            <p class="e-m"><?php echo $user['age'] ?></p>
                          </td>

                          <td>
                            <p class="e-m"><?php echo $user['phone'] ?></p>
                          </td>

                          <td>
                            <p class="e-m"><?php echo $user['adress'] ?></p>
                          </td>


                          <td>
                            <?php


                              if ($user['type'] == 1)
                              {
                                ?>
                                <span class="type e-ty">editor</span>
                                <?php
                              }
                              if ($user['type'] == 2)
                              {
                                ?>
                                <span class="type a-ty">admin</span>
                                <?php
                              }


                             ?>

                          </td>


                          <td>
                            <?php
                              if ($_SESSION['type'] == 2 )
                              {
                                  ?>
                                  <ul>
                                    <li class=" dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                              <a class="dropdown-item" href="users.php?page=edit&id=<?php echo $user['id'] ?>">
                                                <svg width="20" height="auto" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 10C11.3774 9.99976 11.7472 10.1063 12.0666 10.3073C12.386 10.5084 12.642 10.7956 12.805 11.136L11.998 11.943C11.9834 11.6881 11.872 11.4485 11.6864 11.2731C11.5009 11.0978 11.2553 11.0001 11 11H4C3.73478 11 3.48043 11.1054 3.29289 11.2929C3.10536 11.4804 3 11.7348 3 12V13.5C3 14.907 4.579 16 7.5 16C8.154 16 8.74 15.945 9.258 15.844L9.055 16.654C9.035 16.734 9.02 16.816 9.011 16.896C8.542 16.964 8.037 17 7.5 17C4.088 17 2 15.554 2 13.5V12C2 11.4696 2.21071 10.9609 2.58579 10.5858C2.96086 10.2107 3.46957 10 4 10H11Z" fill="black"/>
                                                <path d="M15.807 9.548C15.9807 9.37432 16.1869 9.23656 16.4138 9.14257C16.6407 9.04858 16.8839 9.0002 17.1295 9.0002C17.3751 9.0002 17.6183 9.04858 17.8453 9.14257C18.0722 9.23656 18.2784 9.37432 18.452 9.548C18.6257 9.72167 18.7635 9.92785 18.8575 10.1548C18.9514 10.3817 18.9998 10.6249 18.9998 10.8705C18.9998 11.1161 18.9514 11.3593 18.8575 11.5862C18.7635 11.8131 18.6257 12.0193 18.452 12.193L13.622 17.022C13.3407 17.3035 12.9881 17.5033 12.602 17.6L11.104 17.974C10.9551 18.0109 10.7992 18.0087 10.6515 17.9676C10.5037 17.9265 10.369 17.8479 10.2606 17.7395C10.1521 17.631 10.0735 17.4963 10.0324 17.3486C9.99132 17.2008 9.98912 17.0449 10.026 16.896L10.4 15.398C10.497 15.012 10.696 14.658 10.978 14.378L15.808 9.548H15.807Z" fill="black"/>
                                                <path d="M14.5 9C14.8283 9.00013 15.1535 8.93556 15.4569 8.80997C15.7602 8.68438 16.0359 8.50023 16.2681 8.26806C16.5002 8.03589 16.6844 7.76024 16.81 7.45687C16.9356 7.15349 17.0001 6.82834 17 6.5C17 6.00555 16.8534 5.5222 16.5787 5.11108C16.304 4.69995 15.9135 4.37952 15.4567 4.1903C14.9999 4.00108 14.4972 3.95157 14.0123 4.04804C13.5273 4.1445 13.0819 4.3826 12.7322 4.73223C12.3826 5.08187 12.1445 5.52732 12.048 6.01228C11.9516 6.49723 12.0011 6.99989 12.1903 7.45671C12.3795 7.91353 12.7 8.30397 13.1111 8.57868C13.5222 8.85338 14.0055 9 14.5 9ZM14.5 5C14.8978 5 15.2794 5.15804 15.5607 5.43934C15.842 5.72065 16 6.10218 16 6.5C16 6.89783 15.842 7.27936 15.5607 7.56066C15.2794 7.84197 14.8978 8 14.5 8C14.1022 8 13.7206 7.84197 13.4393 7.56066C13.158 7.27936 13 6.89783 13 6.5C13 6.10218 13.158 5.72065 13.4393 5.43934C13.7206 5.15804 14.1022 5 14.5 5Z" fill="black"/>
                                                <path d="M7.5 2C7.95963 2 8.41475 2.09053 8.83939 2.26642C9.26403 2.44231 9.64987 2.70012 9.97487 3.02513C10.2999 3.35013 10.5577 3.73597 10.7336 4.16061C10.9095 4.58525 11 5.04037 11 5.5C11 5.95963 10.9095 6.41475 10.7336 6.83939C10.5577 7.26403 10.2999 7.64987 9.97487 7.97487C9.64987 8.29988 9.26403 8.55769 8.83939 8.73358C8.41475 8.90947 7.95963 9 7.5 9C6.57174 9 5.6815 8.63125 5.02513 7.97487C4.36875 7.3185 4 6.42826 4 5.5C4 4.57174 4.36875 3.6815 5.02513 3.02513C5.6815 2.36875 6.57174 2 7.5 2V2ZM7.5 3C6.83696 3 6.20107 3.26339 5.73223 3.73223C5.26339 4.20107 5 4.83696 5 5.5C5 6.16304 5.26339 6.79893 5.73223 7.26777C6.20107 7.73661 6.83696 8 7.5 8C8.16304 8 8.79893 7.73661 9.26777 7.26777C9.73661 6.79893 10 6.16304 10 5.5C10 4.83696 9.73661 4.20107 9.26777 3.73223C8.79893 3.26339 8.16304 3 7.5 3Z" fill="black"/>
                                                </svg>

                      edit account
                                              </a>

                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item" href="users.php?page=delete&id=<?php echo $user['id'] ?>">
                                                <svg width="24" height="auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.47 7.5L21.2 6.77C21.3949 6.57507 21.5044 6.31068 21.5044 6.035C21.5044 5.75932 21.3949 5.49494 21.2 5.3C21.0051 5.10507 20.7407 4.99555 20.465 4.99555C20.1893 4.99555 19.9249 5.10507 19.73 5.3L19 6L18.27 5.27C18.0711 5.07507 17.8029 4.96714 17.5244 4.96995C17.2459 4.97276 16.9799 5.08609 16.785 5.285C16.5901 5.48391 16.4821 5.75212 16.4849 6.03061C16.4878 6.3091 16.6011 6.57507 16.8 6.77L17.53 7.5L16.8 8.23C16.6051 8.42494 16.4956 8.68932 16.4956 8.965C16.4956 9.24068 16.6051 9.50507 16.8 9.7C16.9949 9.89494 17.2593 10.0044 17.535 10.0044C17.8107 10.0044 18.0751 9.89494 18.27 9.7L19 9L19.73 9.73C19.9289 9.92494 20.1971 10.0329 20.4756 10.0301C20.7541 10.0272 21.0201 9.91391 21.215 9.715C21.4099 9.51609 21.5179 9.24789 21.5151 8.9694C21.5122 8.6909 21.3989 8.42494 21.2 8.23L20.47 7.5ZM10 11C10.7911 11 11.5645 10.7654 12.2223 10.3259C12.8801 9.88635 13.3928 9.26164 13.6955 8.53074C13.9983 7.79983 14.0775 6.99556 13.9231 6.21964C13.7688 5.44372 13.3878 4.73098 12.8284 4.17157C12.269 3.61216 11.5563 3.2312 10.7804 3.07686C10.0044 2.92252 9.20017 3.00173 8.46927 3.30448C7.73836 3.60723 7.11365 4.11992 6.67412 4.77772C6.2346 5.43552 6 6.20888 6 7C6 8.06087 6.42143 9.07828 7.17157 9.82843C7.92172 10.5786 8.93913 11 10 11ZM10 5C10.3956 5 10.7822 5.1173 11.1111 5.33706C11.44 5.55683 11.6964 5.86918 11.8478 6.23463C11.9991 6.60009 12.0387 7.00222 11.9616 7.39018C11.8844 7.77814 11.6939 8.13451 11.4142 8.41422C11.1345 8.69392 10.7781 8.8844 10.3902 8.96157C10.0022 9.03874 9.60009 8.99914 9.23463 8.84776C8.86918 8.69639 8.55682 8.44004 8.33706 8.11114C8.1173 7.78224 8 7.39556 8 7C8 6.46957 8.21071 5.96086 8.58579 5.58579C8.96086 5.21072 9.46957 5 10 5ZM10 13C8.14348 13 6.36301 13.7375 5.05025 15.0503C3.7375 16.363 3 18.1435 3 20C3 20.2652 3.10536 20.5196 3.29289 20.7071C3.48043 20.8946 3.73478 21 4 21C4.26522 21 4.51957 20.8946 4.70711 20.7071C4.89464 20.5196 5 20.2652 5 20C5 18.6739 5.52678 17.4021 6.46447 16.4645C7.40215 15.5268 8.67392 15 10 15C11.3261 15 12.5979 15.5268 13.5355 16.4645C14.4732 17.4021 15 18.6739 15 20C15 20.2652 15.1054 20.5196 15.2929 20.7071C15.4804 20.8946 15.7348 21 16 21C16.2652 21 16.5196 20.8946 16.7071 20.7071C16.8946 20.5196 17 20.2652 17 20C17 18.1435 16.2625 16.363 14.9497 15.0503C13.637 13.7375 11.8565 13 10 13Z" fill="black"/>
                                                </svg>

                                          delete user
                                              </a>

                                            </div>
                                          </li>
                                  </ul>
                                  <?php
                              }


                              elseif ($_SESSION['id'] == $user['id'] )
                              {
                                ?>
                                <ul>
                                  <li class=" dropdown">
                                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="users.php?page=edit&id=<?php echo $user['id'] ?>">
                                              <svg width="20" height="auto" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11 10C11.3774 9.99976 11.7472 10.1063 12.0666 10.3073C12.386 10.5084 12.642 10.7956 12.805 11.136L11.998 11.943C11.9834 11.6881 11.872 11.4485 11.6864 11.2731C11.5009 11.0978 11.2553 11.0001 11 11H4C3.73478 11 3.48043 11.1054 3.29289 11.2929C3.10536 11.4804 3 11.7348 3 12V13.5C3 14.907 4.579 16 7.5 16C8.154 16 8.74 15.945 9.258 15.844L9.055 16.654C9.035 16.734 9.02 16.816 9.011 16.896C8.542 16.964 8.037 17 7.5 17C4.088 17 2 15.554 2 13.5V12C2 11.4696 2.21071 10.9609 2.58579 10.5858C2.96086 10.2107 3.46957 10 4 10H11Z" fill="black"/>
                                              <path d="M15.807 9.548C15.9807 9.37432 16.1869 9.23656 16.4138 9.14257C16.6407 9.04858 16.8839 9.0002 17.1295 9.0002C17.3751 9.0002 17.6183 9.04858 17.8453 9.14257C18.0722 9.23656 18.2784 9.37432 18.452 9.548C18.6257 9.72167 18.7635 9.92785 18.8575 10.1548C18.9514 10.3817 18.9998 10.6249 18.9998 10.8705C18.9998 11.1161 18.9514 11.3593 18.8575 11.5862C18.7635 11.8131 18.6257 12.0193 18.452 12.193L13.622 17.022C13.3407 17.3035 12.9881 17.5033 12.602 17.6L11.104 17.974C10.9551 18.0109 10.7992 18.0087 10.6515 17.9676C10.5037 17.9265 10.369 17.8479 10.2606 17.7395C10.1521 17.631 10.0735 17.4963 10.0324 17.3486C9.99132 17.2008 9.98912 17.0449 10.026 16.896L10.4 15.398C10.497 15.012 10.696 14.658 10.978 14.378L15.808 9.548H15.807Z" fill="black"/>
                                              <path d="M14.5 9C14.8283 9.00013 15.1535 8.93556 15.4569 8.80997C15.7602 8.68438 16.0359 8.50023 16.2681 8.26806C16.5002 8.03589 16.6844 7.76024 16.81 7.45687C16.9356 7.15349 17.0001 6.82834 17 6.5C17 6.00555 16.8534 5.5222 16.5787 5.11108C16.304 4.69995 15.9135 4.37952 15.4567 4.1903C14.9999 4.00108 14.4972 3.95157 14.0123 4.04804C13.5273 4.1445 13.0819 4.3826 12.7322 4.73223C12.3826 5.08187 12.1445 5.52732 12.048 6.01228C11.9516 6.49723 12.0011 6.99989 12.1903 7.45671C12.3795 7.91353 12.7 8.30397 13.1111 8.57868C13.5222 8.85338 14.0055 9 14.5 9ZM14.5 5C14.8978 5 15.2794 5.15804 15.5607 5.43934C15.842 5.72065 16 6.10218 16 6.5C16 6.89783 15.842 7.27936 15.5607 7.56066C15.2794 7.84197 14.8978 8 14.5 8C14.1022 8 13.7206 7.84197 13.4393 7.56066C13.158 7.27936 13 6.89783 13 6.5C13 6.10218 13.158 5.72065 13.4393 5.43934C13.7206 5.15804 14.1022 5 14.5 5Z" fill="black"/>
                                              <path d="M7.5 2C7.95963 2 8.41475 2.09053 8.83939 2.26642C9.26403 2.44231 9.64987 2.70012 9.97487 3.02513C10.2999 3.35013 10.5577 3.73597 10.7336 4.16061C10.9095 4.58525 11 5.04037 11 5.5C11 5.95963 10.9095 6.41475 10.7336 6.83939C10.5577 7.26403 10.2999 7.64987 9.97487 7.97487C9.64987 8.29988 9.26403 8.55769 8.83939 8.73358C8.41475 8.90947 7.95963 9 7.5 9C6.57174 9 5.6815 8.63125 5.02513 7.97487C4.36875 7.3185 4 6.42826 4 5.5C4 4.57174 4.36875 3.6815 5.02513 3.02513C5.6815 2.36875 6.57174 2 7.5 2V2ZM7.5 3C6.83696 3 6.20107 3.26339 5.73223 3.73223C5.26339 4.20107 5 4.83696 5 5.5C5 6.16304 5.26339 6.79893 5.73223 7.26777C6.20107 7.73661 6.83696 8 7.5 8C8.16304 8 8.79893 7.73661 9.26777 7.26777C9.73661 6.79893 10 6.16304 10 5.5C10 4.83696 9.73661 4.20107 9.26777 3.73223C8.79893 3.26339 8.16304 3 7.5 3Z" fill="black"/>
                                              </svg>

                                      edit account
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="users.php?page=delete&id=<?php echo $user['id'] ?>">
                                              <svg width="24" height="auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M20.47 7.5L21.2 6.77C21.3949 6.57507 21.5044 6.31068 21.5044 6.035C21.5044 5.75932 21.3949 5.49494 21.2 5.3C21.0051 5.10507 20.7407 4.99555 20.465 4.99555C20.1893 4.99555 19.9249 5.10507 19.73 5.3L19 6L18.27 5.27C18.0711 5.07507 17.8029 4.96714 17.5244 4.96995C17.2459 4.97276 16.9799 5.08609 16.785 5.285C16.5901 5.48391 16.4821 5.75212 16.4849 6.03061C16.4878 6.3091 16.6011 6.57507 16.8 6.77L17.53 7.5L16.8 8.23C16.6051 8.42494 16.4956 8.68932 16.4956 8.965C16.4956 9.24068 16.6051 9.50507 16.8 9.7C16.9949 9.89494 17.2593 10.0044 17.535 10.0044C17.8107 10.0044 18.0751 9.89494 18.27 9.7L19 9L19.73 9.73C19.9289 9.92494 20.1971 10.0329 20.4756 10.0301C20.7541 10.0272 21.0201 9.91391 21.215 9.715C21.4099 9.51609 21.5179 9.24789 21.5151 8.9694C21.5122 8.6909 21.3989 8.42494 21.2 8.23L20.47 7.5ZM10 11C10.7911 11 11.5645 10.7654 12.2223 10.3259C12.8801 9.88635 13.3928 9.26164 13.6955 8.53074C13.9983 7.79983 14.0775 6.99556 13.9231 6.21964C13.7688 5.44372 13.3878 4.73098 12.8284 4.17157C12.269 3.61216 11.5563 3.2312 10.7804 3.07686C10.0044 2.92252 9.20017 3.00173 8.46927 3.30448C7.73836 3.60723 7.11365 4.11992 6.67412 4.77772C6.2346 5.43552 6 6.20888 6 7C6 8.06087 6.42143 9.07828 7.17157 9.82843C7.92172 10.5786 8.93913 11 10 11ZM10 5C10.3956 5 10.7822 5.1173 11.1111 5.33706C11.44 5.55683 11.6964 5.86918 11.8478 6.23463C11.9991 6.60009 12.0387 7.00222 11.9616 7.39018C11.8844 7.77814 11.6939 8.13451 11.4142 8.41422C11.1345 8.69392 10.7781 8.8844 10.3902 8.96157C10.0022 9.03874 9.60009 8.99914 9.23463 8.84776C8.86918 8.69639 8.55682 8.44004 8.33706 8.11114C8.1173 7.78224 8 7.39556 8 7C8 6.46957 8.21071 5.96086 8.58579 5.58579C8.96086 5.21072 9.46957 5 10 5ZM10 13C8.14348 13 6.36301 13.7375 5.05025 15.0503C3.7375 16.363 3 18.1435 3 20C3 20.2652 3.10536 20.5196 3.29289 20.7071C3.48043 20.8946 3.73478 21 4 21C4.26522 21 4.51957 20.8946 4.70711 20.7071C4.89464 20.5196 5 20.2652 5 20C5 18.6739 5.52678 17.4021 6.46447 16.4645C7.40215 15.5268 8.67392 15 10 15C11.3261 15 12.5979 15.5268 13.5355 16.4645C14.4732 17.4021 15 18.6739 15 20C15 20.2652 15.1054 20.5196 15.2929 20.7071C15.4804 20.8946 15.7348 21 16 21C16.2652 21 16.5196 20.8946 16.7071 20.7071C16.8946 20.5196 17 20.2652 17 20C17 18.1435 16.2625 16.363 14.9497 15.0503C13.637 13.7375 11.8565 13 10 13Z" fill="black"/>
                                              </svg>

                                          delete account
                                            </a>
                                          </div>
                                        </li>
                                </ul>
                                <?php
                              }
                              else
                              {
                                echo 'You do not have permission to access this content';
                              }
                             ?>

                          </td>

                        </tr>
                        <tr>

                        <?php
                      }
                       ?>



                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php

          if ($_SESSION['type'] == 2)
          {
            ?>

            <?php
          }
     ?>
      <?php
      include $tpl . 'footer.php';

    }
    elseif ($page == 'add') {
      $pageTitle = "add new user";
      include 'init.php';




        if ($_SESSION['type'] == 2)
        {

          ?>
          <div class="add-default-page add-user-page" id="add-page">
            <div class="container cnt-spc">
              <div class="row justify-content-start">
                <div class="col-md-8">
                  <form class="add-fomr" method="POST" action="users.php?page=insert" id="form-info"  >
                    <h3><a style="margin-left:5px;font-size:15px;border-radius: 10px;background:var(--mainColor);color:white;padding:8px" href="users.php?page=manage" class="fas fa-long-arrow-alt-left"></a>  Fill in the information to add a new supervisor </h3>
                    <div class="err-msg">

                    </div>
                      <div class="row">
                        <div class="col-6">
                          <label for="username">username</label>
                          <input type="text" name="username" id="username" placeholder="" class="form-control">
                        </div>
                        <div class="col-6">
                          <label for="username">age</label>
                          <input type="text" name="age" id="username" placeholder="" class="form-control">
                        </div>
                        <div class="col-6">
                          <label for="username">adress</label>
                          <input type="text" name="adress" id="username" placeholder="" class="form-control">
                        </div>
                        <div class="col-6">
                          <label for="username">phone</label>
                          <input type="text" name="phone" id="username" placeholder="" class="form-control">
                        </div>

                        <div class="col-6">
                          <label for="password">password </label>
                          <input type="password" name="npassword" placeholder="" class="form-control">
                        </div>
                        <div class="col-6">
                          <label for="cpassword">confirm password</label>
                          <input type="password" name="cpassword" placeholder="" class="form-control">
                        </div>

                        <div class="col-6">
                          <label for="type">user level </label>
                          <select class="form-control" name="type">
                            <option value="default" selected>select user level</option>
                            <option value="1">editor</option>
                            <option value="2">admin</option>


                          </select>

                        </div>

                      </div>
                    <input type="submit" class="btn btn-primary" id="a-"  value="add">

                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php





          ?>

          <?php
        }else {
          header('location: index.php');
        }
          ?>

          <?php



      ?>


      <?php

      include $tpl . 'footer.php';
    }
    elseif ($page == 'insert') {
      $pageTitle = "insert data";
      include 'init.php';
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $username = $_POST['username'];
        $age = $_POST['age'];
        $adress = $_POST['adress'];
        $npass = $_POST['npassword'];
        $cpass = $_POST['cpassword'];
        $type = $_POST['type'];
        $phone = $_POST['phone'];

        $formErrors = array();
        if (empty($username))
        {
          $formErrors[] = 'username is required';
        }

        if (empty($age))
      {
        $formErrors[] = 'age is required';
      }


        if (empty($cpass))
        {
          $formErrors[] =  'confirm password is required';
        }
        if(!empty($npass))
        {
            if ($npass!=$cpass)
            {
              $formErrors[] = 'passwords not matchs';
            }
            else {
              $password = sha1($_POST['npassword']);
            }
        }


        if ($type == 'default')
        {
          $formErrors[] = 'user leve is required';
        }



        foreach ($formErrors as $error ) {
          ?>
          <div class="container cnt-spc">
            <?php
            echo '<div class="alert alert-danger" >' . $error . '</div>';
            ?>

          </div>
          <?php
        }




        if (empty($formErrors))
        {
          $stmt = $conn->prepare("INSERT INTO users(username, password,phone,age,type,adress, created) VALUES(:zusername, :zpass, :zfname, :zemail, :zgender, :ztype, now())");
          $stmt->execute(array(
            'zusername' => $username,
            'zpass' => $password,
            'zfname' => $phone,
            'zemail' => $age,
            'zgender' => $type,
            'ztype' => $adress

          ));
          ?>
          <div class="alert alert-success" style="margin-top: 15px">
            <p style="text-align:center">  The user has been added successfully. Please reload the page</p>
          </div>
          <?php
          header('refresh:3;url= users.php');
        }



      }

      include $tpl . 'footer.php';
    }
    elseif ($page == 'edit') {
      $pageTitle = "edit account";
      include 'init.php';

      $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');
      $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
      $stmt->execute(array($id));
      $checkIfuserExist = $stmt->rowCount();
      $userInfo = $stmt->fetch();
      if ($checkIfuserExist > 0)
      {

        if ($_SESSION['type'] == 2 or $_SESSION['id'] == $userInfo['id'])
        {

          ?>
          <div class="edit-page user-edit-pages deep-page">
            <div class="container cnt-spc">
              <div class="row">
                <div class="col-md-12">
                  <div class="pg-tt">
                    <h1 dir="rtl" style="display:block;text-align:left">edit user <?php echo $userInfo['username'] ?></h1>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="row">


                  </div>
                  <div class="col-md-12">
                    <div class="left-content">
                      <div class="user-info">
                        <div class="user-info-header">
                          <form class="pic" action="users.php?page=avatupdate&id=<?php echo $userInfo['id'] ?>" method="post" enctype="multipart/form-data">
                            <?php
                                if (empty($userInfo['image']))
                                {
      ?>
                                <img src="<?php echo $avatar  ?>default.png" style="width: 100px;" alt="avart">

      <?php
                                }else {
                                  ?>
                                  <img src="<?php echo $avatar . $userInfo['image'] ?>" style="width: 100px;" alt="avart">

                                  <?php
                                }
                             ?>
                            <p class="username"><?php echo $userInfo['username'] ?></p>
                            <label for="avatar" class="avar-up">upload new picture <i class="fas fa-plus"></i> </label>
                            <input type="file" id="avatar" name="avatar" class="up-ava" style="display:none;">
                            <input type="submit" name="upload" value="save" class="form-control btn btn-primary shw-btn" id="sb-bt">
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="use-fl-info">
                    <form method="post" action="users.php?page=update" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-6">
                          <label for="username">username</label>
                          <input type="text" name="username" id="username" placeholder="" class="form-control" value="<?php echo $userInfo['username'] ?>">
                        </div>
                        <div class="col-6">
                          <label for="username">age</label>
                          <input type="text" name="age" id="username" placeholder="" class="form-control" value="<?php echo $userInfo['age'] ?>">
                        </div>
                        <div class="col-6">
                          <label for="username">adress</label>
                          <input type="text" name="adress" id="username" placeholder="" class="form-control" value="<?php echo $userInfo['adress'] ?>">
                        </div>
                        <div class="col-6">
                          <label for="username">phone</label>
                          <input type="text" name="phone" id="username" placeholder="" class="form-control" value="<?php echo $userInfo['phone'] ?>">
                        </div>
<input type="hidden" name="id" value="<?php echo $userInfo['id'] ?>">
                        <div class="col-6">
                          <label for="password">password </label>
                          <input type="password" name="npassword" placeholder="" class="form-control">
                        </div>
                        <div class="col-6">
                          <label for="cpassword">confirm password</label>
                          <input type="password" name="cpassword" placeholder="" class="form-control">
                        </div>

                        <div class="col-6">
                          <label for="type">user level </label>
                          <select class="form-control" name="type">
                            <option value="default" selected>select user level</option>
                            <option value="1" <?php if ($userInfo['type'] == 1) { echo 'selected'; } ?>>editor</option>
                            <option value="2" <?php if ($userInfo['type'] == 2) { echo 'selected'; } ?>>admin</option>


                          </select>

                        </div>

                      </div>

    <button type="submit" class="btn btn-primary">save</button>
  </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <?php





          ?>

          <?php
        }else {
          header('location: index.php');
        }
          ?>

          <?php


      }
      else {
        header('location: users.php');
      }
      ?>


      <?php

      include $tpl . 'footer.php';
    }elseif ($page == 'avatupdate') {

      include 'init.php';

      $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;


        $imageName = $_FILES['avatar']['name'];
        $imageSize = $_FILES['avatar']['size'];
        $imageTmp = $_FILES['avatar']['tmp_name'];
        $imageType = $_FILES['avatar']['type'];

        $imageAllowedExtension = array("jpeg", "jpg", "png");
        $Infunc = explode('.', $imageName);
        $imageExtension = strtolower(end($Infunc));
        $formErrors = array();
        if (empty($imageName))
        {
          $formErrors[] = 'iamge is required';
        }
        if (!empty($imageName) && ! in_array($imageExtension, $imageAllowedExtension))
        {
          $formErrors[] = 'image extension not allowed';
        }


                                      foreach ($formErrors as $error ) {
                                        ?>
                                        <div class="container">
                                            <?php
                                              echo '<div class="alert alert-danger" style="width: 50%;">' . $error . '</div>';
                                             ?>

                                        </div>
                                        <?php
                                      }



                                                                      if (empty($formErrors))
                                                                      {
                                                                        $image = rand(0,100000) . '_' . $imageName;
                                                                        move_uploaded_file($imageTmp, $avatar . '/' . $image);
                                                                        $stmt = $conn->prepare("UPDATE users SET image = ? WHERE id = ? LIMIT 1 ");
                                                                        $stmt->execute(array($image,$id));
                                                                        ?>

                                                                        <?php
                                                                        header('location: ' . $_SERVER['HTTP_REFERER']);
                                                                      }


                                                                      include $tpl . 'footer.php';
    }

    elseif ($page == 'update') {


      $pageTitle = 'update page';
      include 'init.php';
      $id = $_POST['id'];

                            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
                            $stmt->execute(array($id));
                            $checkIfuser = $stmt->rowCount();
                            $data = $stmt->fetch();

                            if($_SERVER['REQUEST_METHOD'] == 'POST')
                            {

                              $username = $_POST['username'];
                              $age = $_POST['age'];
                              $adress = $_POST['adress'];
                              $pass = $_POST['npassword'];
                              $cpass = $_POST['cpassword'];
                              $type = $_POST['type'];
                              $phone = $_POST['phone'];




                            $formErrors = array();
                            if (empty($username))
                            {
                              $formErrors[] = 'username is required';
                            }

                            if (empty($pass))
                            {
                              $stmt=$conn->prepare("SELECT password FROM users WHERE id = ? LIMIT 1");
                              $stmt->execute(array($id));
                              $passs = $stmt->fetch();

                              $password = $passs['password'];
                            }
                            if(!empty($pass))
                            {
                                if ($pass!=$cpass)
                                {
                                  $formErrors[] = 'كلمة المرور غير مطابقة';
                                }
                                else {
                                  $password = sha1($_POST['cpassword']);
                                }
                            }




                            foreach ($formErrors as $error ) {
                              ?>
                              <div class="container">
                                  <?php
                                    echo '<div class="alert alert-danger" style="width: 50%;">' . $error . '</div>';
                                   ?>

                              </div>
                              <?php
                              ?>
                                <div class="container">
                                  <a href="users.php?page=edit&id=<?php echo $id ?>">اضغط هنا للعودة الى اخر صفحة</a>
                                </div>
                              <?php
                              // header('refresh:4;url=' . $_SERVER['HTTP_REFERER']);
                            }


                            if (empty($formErrors))
                            {

                              $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? , phone = ?, age= ?, type = ?, adress = ?
                                 WHERE id=?  ");
                              $stmt->execute(array($username,$password,$phone,$age,$type,$adress,$id));
                              header('location: ' . $_SERVER['HTTP_REFERER']);
                            }
                          }


      include $tpl . 'footer.php';


    }elseif ($page == 'delete') {
     include 'init.php';
      if ($_SESSION['type'] == 2)
      {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->execute(array($id));
        $pfl = $stmt->fetch();
        $check = $stmt->rowCount();


          $stmt = $conn->prepare("DELETE FROM users WHERE id = :zid");
          $stmt->bindParam(":zid", $id);
          $stmt->execute();
          header('location: users.php');



      }
    }elseif ($page == 'activate') {
      if (isset($_SESSION['type']) == 2)
      {
        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;

          $stmt = $conn->prepare("UPDATE users SET status = 1 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:users.php');
      }
    }
    elseif ($page == 'deactivate') {
      if (isset($_SESSION['type']) == 2)
      {
        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;

          $stmt = $conn->prepare("UPDATE users SET status = 0 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:users.php');
      }
    }

    else {
      header('location: dashboard.php');
    }

    ?>


    <?php


  }else {
    header('location: logout.php');
  }
  ob_end_flush();
 ?>

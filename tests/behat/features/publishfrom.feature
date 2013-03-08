Feature: Greeting plugin standart features BDD
    Test base functionality of LiveStreet publishfrom plugin standart

    @mink:selenium2
    Scenario: publishfrom LiveStreet CMS
        #login
        Given I am on "/login"
        	Then I wait "2000"
            Then I want to login as "admin"
			Then I am on "/topic/add"
			Then I fill in "topic_title" with "test topic1"
			Then I fill in "topic_text" with " <a href='http://goloskarpat.info/'>goloskarpat.info</a>"
			Then I fill in "topic_tags" with "test topic"
			Then I press element by css "#submit_topic_publish"
			Then I wait "2000"
			Then the response should not contain "rel=\"nofollow\""



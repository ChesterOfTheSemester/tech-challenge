## Changelog

### Summary
- Implemented search functionality with type filtering (`info`, `download`, `WEBLINK`).
- Ensured all search parameters persist when submitting the form.
- Fixed database errors by ensuring `button_text` is always set for `download` and `weblink` entries.
- Added deletion feature by adding `deleteRoute` function in `ziggy.ts`, using Inertia’s `router.delete()` to send the request, trigger a confirmation, and reload the page on completion.

#### Remaining Tasks:
- Implement items restoration.
- Implement item force deletion.
- Implement pagination for large results.
- Improve error handling for missing or invalid input.
- Enhance the user interface for a smoother experience.
- Add loading indicators for better user feedback.

~ Chester

---


<p align="center">
  <a href="https://dblx.co.uk" target="_blank">
    <picture>
      <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/dblx-dev/tech-challenge/HEAD/.github/logo-dark.svg">
      <source media="(prefers-color-scheme: light)" srcset="https://raw.githubusercontent.com/dblx-dev/tech-challenge/HEAD/.github/logo-light.svg">
      <img alt="DBLX" src="https://raw.githubusercontent.com/dblx-dev/tech-challenge/HEAD/.github/logo-light.svg" width="350" height="120" style="max-width: 100%;">
    </picture>
  </a>
</p>

# Tech Challenge

## Scenario

One of our developers has started a project for Company Y, and they have gone on holiday for 2 weeks, in order to continue development and keep pace with deliverable deadlines you have been asked to take over for the coming sprint.

What has been produced so far can be considered unstable and not fully released to the client yet, so feel free to make any improvements that you see fit as you work your way through and maybe fix any bugs that QA or the client failed to find, if there are any.

The 3 Jira tickets assigned to this sprint are:

BSP-Y-034:

- Implement Search functionality for Items
- This should bring back their Name, Description and Type (with relevant content) to display to the end user

BSP-Y-027:

- Add in delete functionality for Items

BSP-Y-35:

- Extend the current functionality of searching to add in a type filter to narrow down items

### Submission

Fork the repository and make your commits against that, then when finished give the following users access:

- [ashleyshenton](https://github.com/ashleyshenton)
- [chrishyndadblx](https://github.com/chrishyndadblx)

There should be a full complement of seeders to get you up and running as fast as possible.

We appreciate that this task will be done outside your normal working hours, and we value a healthy work-life balance, so please spend no more than 3 hours working on this.
We are an agile business so some sprints may go over the targeted time, and given your experience with the stack this may also happen here.
If you find yourself nearing the deadline either create a TODO.md in the root directory with a small summary of what’s left and a bit of information on how you would tackle it given another sprint,
or add in some commented pseudocode in the relevant routes/controllers/actions/service providers briefly outlining your approach.
